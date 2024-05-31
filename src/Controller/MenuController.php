<?php

namespace ChapterThree\C3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    private string $base_url;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->base_url = $router->getContext()->getBaseUrl();
    }

    #[Route('/menu/{page}', name: 'menu')]
    public function index($page): Response
    {
        if ($this->container->has('app.menu')) {
            $menu = $this->getMenuArray($this->getParameter('app.menu'));
        }else {
            $menu = [['title'=>'メニュー未設定', 'url'=>'/']];
        }

        return $this->render('@C3/menu.html.twig', [
            'page' => $page,
            'menu' => $menu
        ]);
    }

    #[Route('/menu/button')]
    public function button($page): Response
    {
        return $this->render('@C3/menu_button.html.twig', [
            'page' => $page,
            'menu' => $this->getMenuArray($this->getParameter('app.menu'))
        ]);
    }

    private function getMenuArray($menu_list)
    {
		foreach ($menu_list as $key=>$value){
			if (is_array($value)){
				$menu_list[$key] = $this->getMenuArray($value);
			}
			if (strtolower($key) == 'url') {
				if (str_starts_with($value, 'http'))
					$menu_list[$key] = $value;
				else
					$menu_list[$key] = $this->base_url . $value;
			}
		}
        return $menu_list;
    }

    #[Route('/menu/write', name: 'menu_write')]
    public function write(): Response
    {
        $data = [];
        //$data = $this->getMenu();
        $data = ['parameters'=>['app.menu'=>$data]];
        $data = Yaml::dump($data,5);
        //file_put_contents('../config/packages/chapter_three_menu.yaml', $data);
        return new Response('ok');
    }

    #[Route('/menu/command', name: 'menu_command')]
    public function command(): Response
    {
        $kernel = $this->container->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'cravler:maxmind:geoip-update'
        ));
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        dump($content);

        return $this->render('@C3/default/index.html.twig');
    }

}
