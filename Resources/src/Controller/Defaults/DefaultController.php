<?php
namespace App;

#use App\Form\RegistrationFormType;
use ChapterThree\C3Bundle\Service\Slack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Attribute\Route;

#use Doctrine\ORM\EntityManagerInterface;
#use Symfony\Component\Security\Http\Attribute\IsGranted;

//use App\Repository\NewsRepository;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//use Symfony\Component\Routing\Annotation\Route;


#[Route('/')]
##[IsGranted("ROLE_USER")]
class DefaultController extends AbstractController
{
    private $config;

    #[Route('/', name: 'homepage')]
    public function index(Request $request,
//                          NewsRepository $newsRepository,
                          NotifierInterface $notifier,
                          ChatterInterface $chatter
    )
    {
        // replace this example code with whatever you need
        /*if (($this->getUser()->getUsername() == "admin@chapter-three.jp")){
            $this->addFlash("warning","<a href='https://www.google.co.jp'>お知らせイング</a>" );
        }*/

        $message = $this->getParameter('adminEmail');
        $message = $request->query->get('entity');
        //echo "<pre>{$message}</pre>";

        return $this->render('default/index.html.twig'
            ,array(
                'news' => null, //$newsRepository->findNews(),
                //'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'body'=>true,
            )
        );
    }

    /**
     * @Route("/profile", name="profile")
     *
     */
    #[Route("/profile", name: "profile")]
    public function profile(Request $request, EntityManagerInterface $entityManager, Slack $slack)
    {
        $slack->send("Test");
        $user = $this->getUser();
        $form = $this->createForm(\App\Controller\Defaults\RegistrationFormType::class, $user);
        $form
            ->remove('password')
            ->remove('legal');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('info', '登録しました。');
        }

        return $this->render(
            "default/profile.html.twig", [
                'form' => $form->createView()
            ]
        );
    }



    /**
     * @Route("/run", name="run")
     */
    #[Route('/run', name: 'run')]
    public function runAction(Request $request)
    {
        $repo_key = $request->get('repo_key');
        if(!empty($request->get('code'))) {
            $keyword = urldecode(trim($request->get('code')));
            $keyword = $request->get('code');
            $code = (string)$request->getContent();
            $code = str_replace("code=","", $code);
            //$code = str_replace("[_PLUS_]","+", $code);
            // remove PHP start and end tags
            $code = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $code);
            $code = trim($code);
        }else{
            // default code
            $keyword = "\n\$params = array('product_id'=>5153);\nlist(\$res) = array(\$params);\nreturn \$res;";
        }
        $keyword = str_replace("<?php","",$keyword);

        /*
        chdir($repository_info['path']);
        $cmd = "ls -l {$keyword}";
        $result = shell_exec($cmd);
        */
        //$my_code = '$my_function; $my_function = function () {' . $keyword . '}; return array($my_function());';
        //$result = eval($my_code);

        global $my_function;
        $my_code = 'require_once(DIR_ROOT . "/app/Tygh/Registry.php"); require_once(DIR_ROOT . "/app/Tygh/Settings.php"); global $my_function; $my_function = function () { ' . $keyword . ' };';
        $my_code = 'global $my_function; $my_function = function () { ' . $keyword . ' };';
//        echo '<pre style="margin: 10px 250px;">';
        //eval($my_code);
        //$result = var_export($my_function(), true);
        $result = "";
//        echo '</pre>';

        return $this->render('default/run.html.twig',array(
            'repo_key'=> $repo_key,
            'keyword' => $keyword,
            'result' => $result,
        ));
    }

    #[Route('/eval', name: 'eval')]
    public function evalAction(Request $request)
    {
        error_reporting(-1);
        ini_set('display_errors', 'on');
        header('Content-Type: text/html; charset=utf-8');
        if (!empty($request->get('code'))) {
            try{
                //$code = $request->request->get('code');
                $code = (string)$request->getContent();
                //return new Response(var_dump($code, true));
                $code = str_replace("code=","", $code);
                //$code = str_replace("[_PLUS_]","+", $code);
                // remove PHP start and end tags
                $code = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $code);
                $code = preg_replace('/(.*)(\?>)/s', '$1', $code);
                $code = trim($code);
                //return new Response(var_dump($code, true));
                // output buffered evaluation
                ob_start();
                global $my_function;
                //$my_code = 'require_once(DIR_ROOT . "/app/Tygh/Registry.php"); require_once(DIR_ROOT . "/app/Tygh/Settings.php"); global $my_function; $my_function = function () { ' . code . ' };';
                $my_code = 'global $my_function; $my_function = function () {try{' . $code . '}catch (\Exception $e){return $e->getMessage();} };';
                eval($my_code);
                $result = var_export($my_function(), true);
                $buffer = ob_get_clean();
                if (empty($buffer)) $buffer=$result;
                // error handling
                $error = error_get_last();
                if ($error > 0) {
                    // errors contains: type, message, file, line
                    // now we add the error "type" as "error" with a friendly error name
                    $error['error'] = $this->getErrorName($error['type']);
                    $jsonError = json_encode($error, true);
                    /* Send the error
                       - name as text/html (to the codemirror-result area)
                       - array as json via header
                     */
                    header('Z-Error: ' . $jsonError);
                    return new Response(strtoupper($error['error']));
                } else {
                    return new Response($buffer);
                }

            } catch ( \Exception $ex ) {
                return new Response($ex->getMessage());
            }

        }

        return new Response('');
    }
    private function getErrorName($errorInt)
    {
        $errortypes = array(
            E_ERROR => 'error',
            E_WARNING => 'warning',
            E_PARSE => 'parsing error',
            E_NOTICE => 'notice',
            E_CORE_ERROR => 'core error',
            E_CORE_WARNING => 'core warning',
            E_COMPILE_ERROR => 'compile error',
            E_COMPILE_WARNING => 'compile warning',
            E_USER_ERROR => 'user error',
            E_USER_WARNING => 'user warning',
            E_USER_NOTICE => 'user notice'
        );
        return $errortypes[$errorInt];
    }

    #[Route('/memo', name: 'memo')]
    public function memoAction(Request $request)
    {
        $entiry = new \App\Entity\Sample\Task();
        $form = $this->createForm( str_replace('Entity', 'Form', ''.get_class($entiry)."Type"), $entiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entiry);
            $entityManager->flush();

            return $this->redirectToRoute('memo');
        }


        return $this->render('default/memo.html.twig',[
            'body'=>true,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/demo/{page}', name: 'etc', defaults: ['page'=>'index.html'], requirements: ['page'=>'^(?!task|orders).+'])]
    public function etcAction($page)
    {
        if (in_array(substr($page,0,4) ,['task','orde'])){
            //return new Response('task:'.str_replace('/','',$page));
            return $this->redirectToRoute(str_replace('/','',$page));
        }

        $aTemplateFile =''.$page;

        return $this->render( $aTemplateFile
            ,array(
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'site_name'=>'list',
                'body'=>true,
                'version'=>'1.1'
            )
        );
    }

}
