<?php

namespace ChapterThree\C3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    private $base_url;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->base_url = $router->getContext()->getBaseUrl();
    }

    #[Route('/menu/{page}', name: 'menu')]
    public function index($page)
    {
        return $this->render('@C3/menu.html.twig', [
            'page' => $page,
            'menu' => $this->getMenuArray($this->getParameter('app.menu'))
        ]);
    }

    #[Route('/menu/button')]
    public function button($page)
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
				if (substr($value, 0, 4) == 'http')
					$menu_list[$key] = $value;
				else
					$menu_list[$key] = $this->base_url . $value;
			}
		}
        return $menu_list;
    }

    #[Route('/menu/write', name: 'menu_write')]
    public function write()
    {
        $data = [];
        //$data = $this->getMenu();
        $data = ['parameters'=>['app.menu'=>$data]];
        $data = Yaml::dump($data,5);
        //file_put_contents('../config/packages/chapter_three_menu.yaml', $data);
        return new Response('ok');
    }

}
