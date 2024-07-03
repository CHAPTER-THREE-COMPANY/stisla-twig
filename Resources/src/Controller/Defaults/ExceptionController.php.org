<?php

namespace App\Controller\Defaults;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\Notifier\Bridge\Slack\Block\SlackSectionBlock;
use Symfony\Component\Notifier\Bridge\Slack\SlackOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use Twig\Environment;

/**
 * Class ExceptionController
 * @package App\Controller
 *
 * 404 controller for STISlA Template Demo
 */
class ExceptionController extends AbstractController
{
    private $debug;
    private $twig;

    public function __construct(Environment $twig)
    {
        //$this->debug = $debug;
        $this->twig = $twig;
    }

    public function showException(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, ChatterInterface $chatter): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        if ($this->getParameter('kernel.debug')) {
            $this->debug = true;
        }
        //return new Response(var_export($request->getPathInfo()));
        if ($request->getPathInfo() != '/' && $this->fileExistTempDir($request->getPathInfo())){
            dump(substr($request->getPathInfo(),0,10));
            return $this->redirect('./demo'.$request->getPathInfo());
        }elseif (substr($request->getPathInfo(),0,7) == '/public') {
            return $this->redirect(substr($request->getPathInfo(), 7));
        }
        /*$err = new ExceptionController($this->twig, $this->debug);
        return $err->redirect("/_error/".$exception-> getStatusCode());*/

        if (strpos($request->headers->get('User-Agent'), 'Slackbot-LinkExpanding')){
            $message = (new ChatMessage('errors-' . $exception-> getStatusCode()))
                // if not set explicitly, the message is send to the
                // default transport (the first one configured)
                ->options((new SlackOptions())
                    ->username('Super Log')
                    //->channel('log')
                    ->block((new SlackSectionBlock())
                        ->text(
                            '*'.$exception->getMessage().'('.$exception->getCode().')*'.PHP_EOL
                            .$request->getPathInfo()
                            , true)
                    )
                );
            $chatter->send($message);
        }


        if (!$this->debug){
            $template = 'errors-' . $exception-> getStatusCode() . '.html';
            //dump($exception->getAllPrevious());
            return new Response($this->renderView($template, $exception->getAllPrevious()));
        }else{
            throw new Exception( $exception->getMessage(), $exception->getCode());
        }

    }

    private function fileExistTempDir($file)
    {
        if (file_exists(dirname(__DIR__) . "/../../node_modules/stisla-dev" .$file))
            return true;
        elseif (file_exists(dirname(__DIR__) . "/../../node_modules/stisla-dev/pages" .$file))
            return true;
        else
            return false;
        //return dirname(__DIR__) . "/../../templates/stisla" .$file;
    }

}
