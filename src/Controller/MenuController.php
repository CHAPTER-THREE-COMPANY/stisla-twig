<?php

namespace ChapterThree\C3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index($page)
    {
        return $this->render('menu.html.twig', [
            'page' => $page,
            'menu' => $this->getMenu()
        ]);
    }

    private function getMenu(): array
    {
        $menu = [];

        // Default::index にも、保護コード解除あり
        $menu = array_merge($menu, [
            ['group'=>'ダッシュボード', 'icon'=>'fas fa-user', 'title'=>'派遣ダッシュボード', 'url'=>'/'],
            ['group'=>'ダッシュボード', 'icon'=>'fas fa-user-tie', 'title'=>'社員ダッシュボード', 'url'=>'/'],

            ['group'=>'拠点メニュー', 'title'=>'本社', 'icon'=>'fas fa-building', 'url'=>'/shift/calender/honsya'],
            ['group'=>'拠点メニュー', 'title'=>'柏 センター', 'icon'=>'fas fa-building', 'url'=>'/shift/calender/kashiwa'],
            ['group'=>'拠点メニュー', 'title'=>'流山センター', 'icon'=>'fas fa-users', 'url'=>'/shift/calender/nagareyama'],
            ['group'=>'拠点メニュー', 'title'=>'辰巳センター', 'icon'=>'fas fa-warehouse', 'url'=>'/shift/calender/tatsumi'],
            ['group'=>'拠点メニュー', 'title'=>'浦和センター', 'icon'=>'fas fa-store', 'url'=>'/shift/calender/urawa'],
            ['group'=>'管理メニュー',
                'item'=>[
                    [
                        'icon'=>'fa-columns',
                        'title'=>'本部メニュー',
                        'item'=>[
                            ['url'=>'/news/list', 'title'=>'お知らせ登録'],
                            //['url'=>'/admin',  'title'=>'DB操作'],
                        ]
                    ],
                ]
            ],
            ['group'=>'その他メニュー', 'title'=>'TOP', 'icon'=>'fas fa-building', 'url'=>'/'],
        ]);
        return $menu;
    }

}
