<?php

namespace ChapterThree\C3Bundle\Controller\media;

use ChapterThree\C3Bundle\Form\FileuploadType;
use ChapterThree\C3Bundle\Service\FileUploader;
use JetBrains\PhpStorm\NoReturn;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class AWSS3Controller
 * @package App\Controller\media
 * @Route("/media")
 */
#[Route('/media')]
class AWSS3Controller extends AbstractController
{
    public function __construct(private readonly AwsS3 $s3)
    {
    }

    #[Route('/aws/s3', name: 'aws_s3')]
    public function index(Request $request, FileUploader $fileUploader, LoggerInterface $logger): Response
    {
        ini_set('max_file_uploads', '200M');

        $fileUpload = new Fileupload();
        $form = $this->createForm(FileuploadType::class, $fileUpload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $aFile */
            $aFile = $form['filename']->getData();
            if ($aFile) {
                $tmp = $aFile;
                $fileName = $fileUploader->upload($aFile);
                $logger->info($fileName);
                $this->s3->upload($tmp,$fileName,$form['savePath']->getData());
            }

            return $this->redirectToRoute('aws_s3');
        }

        return $this->render('@C3/media/aws_s3/index.html.twig', [
            'data' => [],
            'form' => $form,
        ]);
    }

    private function ListAllObjects(/*$bucketPrefix, */$marker = null, $delimiter=null) : array
    {
        $objects = $this->s3->ListObjects([
            'Bucket' => $this->s3->bucket,
            //'Prefix' => $bucketPrefix,
            'Marker' => $marker,
            //'Delimiter' => $delimiter
        ]);


        $list = array();
        if(isset($objects["Contents"])){
            // 取得したファイルのリストを$list配列に追加していく。
            /*foreach ((array)$objects["Contents"] as $object) {
                // フォルダはスルー。ファイルのみ追加。
                if(substr($object['Key'],-1,1) != "/"){
                    array_push($list, "s3://{$this->s3->bucket}/{$object['Key']}");
                }
            }*/
            $list = array_merge($list, $objects["Contents"]);
            // リストの結果が1000件超えの場合、IsTruncated がTRUEで返ってくる。=> FALSEになるまで繰り返せば良い。
            if($objects["IsTruncated"] === true){
                //$key = ltrim($objects["Contents"][count($objects["Contents"])-1],"s3://{$this->s3->bucket}/");  // S3キー部分を取り出すして、これをMarkerに指定する。
                $key = $objects["Contents"][count($objects["Contents"])-1]['Key'];
                $list = array_merge($list, $this->ListAllObjects(/*$bucketPrefix, */$key, $delimiter)); // 再帰処理
            }
        }

        return $list;
    }

    #[Route('/aws/s3/data', name: 'aws_s3_data', methods: ['POST'])]
    public function data(Request $request) : jsonResponse
    {
        // CSRF Check 他のサイトからの不正アクセスを防ぐ
        if (!$this->isCsrfTokenValid('fileManage-get-items', $request->getPayload()->get('token'))) {
            throw new AccessDeniedHttpException('CSRF token invalid. ');
        }

        //$objects = $this->s3->listObjects();
        //$objects = $objects->toArray()['Contents'];
        $objects = $this->ListAllObjects();

        $makeFileArray = function ($files, $file, $object) use (&$makeFileArray) {
            if (mb_strpos($file, '/') === false) {
                $files[] = [
                    $file,
                    'name' => $file,
                    'file' => mb_strtolower(mb_substr($file, mb_strpos($file, '.')+1)),
                    'url' => urldecode($this->generateUrl('aws_s3_download').'?filename='.$object['Key'])
                ];
            }else{
                $dir1 = mb_substr($file, 0, mb_strpos($file, '/'));
                if (mb_strpos($file, '/')+1 == mb_strlen($file)){
                    $files[] = [
                        'name' => $dir1,
                        'div' => 'dir',
                        'children' => [],
                        'url' => urldecode($this->generateUrl('aws_s3_download').'?filename='.$object['Key'])
                    ];
                }else{
                    $file1 = mb_substr($file, mb_strpos($file, '/')+1);
                    foreach ($files as $key => $tmp){
                        if ($tmp['name'] == mb_substr($file, 0, mb_strpos($file, '/'))){
//                            if (!isset($files[$key]['children'])) $files[$key]['children'] =[];
//                            $files[$key]['children'] = $makeFileArray($files[$key]['children'], $file1, $object);
                            if (!isset($tmp['children'])) $files[$key]['children'] =[];
                            $files[$key]['children'] = $makeFileArray($files[$key]['children'], $file1, $object);
                        }
                    }
                }
            }
            return $files;
        };
        $files = array();
        foreach ($objects as $object){
            $files = $makeFileArray($files, $object['Key'], $object);
        }

        return new JsonResponse($files);
    }

    #[NoReturn] #[Route('/aws/s3/download', name: 'aws_s3_download')]
    public function download(Request $request) : void
    {
        $filename = $request->get('filename');
        $filename = urldecode($filename);

        $this->s3->download($filename);
        exit();
    }
}
