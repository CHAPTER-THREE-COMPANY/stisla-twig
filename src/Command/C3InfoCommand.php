<?php

namespace ChapterThree\C3Bundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'c3:info',
    description: 'c3-bundle の利用方法を説明します',
)]
class C3InfoCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->title("CHAPTER-THREE SUPER BUNDLE");

        $io->ask("初期設定方法を説明します[enter]");

        $io->writeln("初期設定");
        $io->listing([
            '1. importmap(\'app\') 用 jsファイル先頭に１行追加',
            '     対象ファイル : asset/app.js',
            '     追加内容 : import \'../vendor/chapter-three-company/c3-bundle/assets/app.js\'',
            '2. 設定ファイルのコピー',
            '     コピー元 : vender/chapter-three-company/c3-bundle/Resouces/config/ (２ファイル)',
            '     コピー先 : config/packages/ ',
            '3. importmap.php 内容追加',
            '     コピー元 : vender/chapter-three-company/c3-bundle/importmap.php ',
            '     コピー先 : importmap.php ',
            '---------↑ ここまでは初回1回のみ ↑---------',
            '4. importmap install',
            '     symfony console importmap:install',
            '5. importmap コンパイル',
            '     symfony console asset-map:compile',
            '6. キャッシュクリア',
            '     symfony console cache:clear',
        ]);
        $io->note("composer require 後に 上記を行ってください");

        $io->ask("つぎに利用方法を説明します[enter]");

        $io->writeln("利用方法");
        $io->listing([
            '全てのtwig templateに適用させる',
            '     1. templates/base.html.twig バックアップ',
            '     2. templates/base.html.twig の編集',
            '          {% extends \'@C3/_base.html.twig\' %}',
            '          上記１行のみに変更',
            'ページ単位で適用させる',
            '     1. ***.html.twig の先頭を書き換え',
            '          変更前 : {% extends \'_base.html.twig\' %}',
            '          変更後 : {% extends \'@C3/_base.html.twig\' %}',
        ]);

        $io->ask("最後に開発方法を説明します[enter]");

        $io->writeln("開発方法");
        $io->listing([
            'バンドルを開発モードでインストールする',
            '     1. symfony composer req chapter-three-company/c3-bundle:dev-main',
            'バンドルをアンインストールする',
            '     1. symfony composer remove chapter-three-company/c3-bundle',
            'バンドルの開発',
            '     1. バンドルの開発',
            '     2. バンドルの git commit & push',
            '     3. 反映側 : symfony composer update chapter-three-company/c3-bundle',
            '     4. 必要時 : symfony console asset-map:compile',
            '     5. 必要時 : symfony console cache:clear',
            'バンドルをインストール後の確認方法',
            '     1. symfony console c3:',
            '          c3:config',
            '          c3:info',
            '          c3:setup',
            '          などが表示される',
            '     2. symfony console debug:asset-map',
            '          @C3 の assets が表示される',
        ]);

        $io->success('上記利用方法を設定してください.');




        return Command::SUCCESS;
    }
}
