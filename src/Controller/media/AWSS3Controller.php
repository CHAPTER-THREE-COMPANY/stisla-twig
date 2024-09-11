<?php

namespace ChapterThree\C3Bundle\Controller\media;

use Aws\S3\Exception\S3Exception;
use ChapterThree\C3Bundle\Service\AwsS3;
use ChapterThree\C3Bundle\Service\Slack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class AWSS3Controller
 * @package App\Controller\media
 */
#[Route('/media')]
class AWSS3Controller extends AbstractController
{

    public function __construct(
        private AwsS3 $s3,
        private Slack $slack)
    {
    }

    #[Route('/aws/s3', name: 'aws_s3')]
    public function index()
    {
        ini_set('memory_limit', '-1');
        
        return $this->render('media/awss3/index.html.twig', [
            //'data' => $objects,
            'data' => [],
        ]);
    }
    
    private function ListAllObjects(/*$bucketPrefix, */$marker = null, $delimiter=null) {

        try {
            $result = $this->s3->getObject([
                'Bucket' => $this->s3->bucket,
                'Key' => 's3-symfony/filelist.json'
            ]);

            if (!empty($result['Body'])) {
                return json_decode($result['Body'], true);
            } else {
                $this->slack->send('NoSuchKey!!!');
            }
        }catch (S3Exception $exception){
            if ($exception->getAwsErrorCode() != 'NoSuchKey'){
                $this->slack->send("s3 exception");
                $this->slack->send($exception);
            }
            // to Make FileList.Json
        }catch (\Exception $exception){
            $this->slack->send($exception);
        }

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

        $this->s3->putObject([
            'Key' => 's3-symfony/filelist.json',
            'Body' => json_encode($list)
        ]);
    
        return $list;
    }

    #[Route('/aws/s3/data', name: 'aws_s3_data')]
    public function data()
    {
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
                    ];
                }else{
                    $file1 = mb_substr($file, mb_strpos($file, '/')+1);
                    foreach ($files as $key => $tmp){
                        if ($tmp['name'] == mb_substr($file, 0, mb_strpos($file, '/'))){
                            if (!isset($files[$key]['children'])) $files[$key]['children'] =[];
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

    #[Route('/aws/s3/download', name: 'aws_s3_download')]
    public function download(\Symfony\Component\HttpFoundation\Request $request)
    {
        $filename = $request->get('filename');
        $filename = urldecode($filename);

        $this->s3->download($filename);
        exit;
    }
}
