<?php

namespace ChapterThree\C3Bundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'c3:setup',
    description: 'c3-bundle のセットアップを実行します',
)]
class C3SetupCommand extends Command
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

        $io->title("CHAPTER-THREE SUPER BUNDLE");

        if (!$io->confirm("初期設定を実行します", true)) {
            $io->info("処理を中止します.");
            return Command::FAILURE;
        }

        $filesystem = new Filesystem();
        $VENDOR = Path::canonicalize(__DIR__.'/../../').'/';
        $IMPORT = $VENDOR.'importmap.php';

        $io->section(".yaml 設定");

        if ($io->confirm('config/packages/chapter-three.yaml を処理します', false)) {
            if (!$filesystem->exists('config/packages/chapter-three.yaml')) {
                $filesystem->copy($VENDOR . 'Resources/config/chapter-three.yaml', 'config/packages/chapter-three.yaml');
            } else {
                $io->warning("config/packages/chapter-three.yaml is exist. does not copy");
            }
        }

        if ($io->confirm('config/packages/chapter-three_menu.yaml を処理します', false)) {
            if (!$filesystem->exists('config/packages/chapter-three_menu.yaml')) {
                $filesystem->copy($VENDOR . 'Resources/config/chapter-three_menu.yaml', 'config/packages/chapter-three_menu.yaml');
            } else {
                $io->warning("config/packages/chapter-three_menu.yaml is exist. does not copy");
            }
        }

        $io->section("importmap.php 設定");

        // Check Vendor Mode
        if (!$filesystem->exists($IMPORT)){
            $io->warning("symfony composer require chapter-three-compony/c3-bundle を実行してください。");
            return Command::FAILURE;
        }
        if ($io->confirm('importmap.php を編集します', false)) {
            $imp2 = include($IMPORT);
            $imp1 = include('importmap.php');
            $import = array_merge($imp1, $imp2);

            $filesystem->rename('importmap.php', "importmap.php." . (date("YmdHis")));

            $export = var_export($import, TRUE);
            $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
            $array = preg_split("/\r\n|\n|\r/", $export);
            $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [NULL, ']$1', ' => ['], $array);
            $export = join(PHP_EOL, array_filter(["["] + $array));
            $content = "<?php\n\n\nreturn " . $export . ";";

            $filesystem->dumpFile('importmap.php', $content);
            $io->info("importmap.php を編集しました.");
        }

        $io->section("app.js 編集");

        // assets/app.js 編集
        if ($io->confirm('assets/app.js を編集します', false)) {
            $appjs = $filesystem->readFile('assets/app.js');
            if (!preg_match('/^import \'..\/vendor\/chapter-three-company\/c3-bundle\/assets\/app\.js\'$/m', $appjs)) {
                $appjs = $appjs. "\n\n//stislaデザイン用にコメントアウト\nimport '../vendor/chapter-three-company/c3-bundle/assets/app.js';";
                $filesystem->dumpFile('assets/app.js', $appjs);

                $io->info("assets/app.js を編集しました.");
            }
        }

        // base.html.twig 編集
        if ($io->confirm('base.html.twig を編集しますか？', false)) {
            $filesystem->rename('templates/base.html.twig', "templates/base.html.twig." . (date("YmdHis")));
            $filesystem->dumpFile('templates/base.html.twig', "{% extends '@C3/base.html.twig' %}\n");

            $io->info("base.html.twig を編集しました.");
        }

        // templates
        // base.html.twig 編集
        if ($io->confirm('template を追加しますか？', false)) {
            $finder = new Finder();

            $io->writeln("src/Controller/Defaults");
            $finder->files()->in($VENDOR.'Resources/src/Controller/Defaults/');
            foreach ($finder as $file) {
                $filesystem->copy(
                    $VENDOR. 'Resources/src/Controller/Defaults/'.$file->getRelativePathname(),
                    'src/Controller/Defaults/'.$file->getRelativePathname());
            }
            $io->writeln("templates/default");
            $finder->files()->in($VENDOR.'templates/default/');
            foreach ($finder as $file) {
                $filesystem->copy(
                    $VENDOR. 'templates/default/'.$file->getRelativePathname(),
                    'templates/default/'.$file->getRelativePathname());
            }
            $io->writeln("templates/news");
            $finder->files()->in($VENDOR.'templates/news/');
            foreach ($finder as $file) {
                $filesystem->copy(
                    $VENDOR. 'templates/news/'.$file->getRelativePathname(),
                    'templates/news/'.$file->getRelativePathname());
            }
        }


        $io->success('設定完了しました.');

        $io->writeln("以下の実行します.");
        $io->writeln('symfony console importmap:install');
        $io->writeln('symfony console asset-map:compile');
        $io->writeln('symfony console cache:clear');

        $application = $this->getApplication();
        $application->setAutoExit(false);

        $io->section("コマンド実行");
        $io->ask('symfony console importmap:install');
        $application->run(new ArrayInput(['command' => 'importmap:install']), $output);
        if ($filesystem->exists("vendor/chapter-three-company/c3-bundle/assets/app.js")) {
            $io->ask('symfony console asset-map:compile');
            $application->run(new ArrayInput(['command' => 'asset-map:compile']), $output);
        }else{
            $io->writeln('symfony console asset-map:compile');
            $io->warning("symfony composer require chapter-three-compony/c3-bundle を実行してください。");
        }
        $io->ask('symfony console cache:clear');
        $application->run(new ArrayInput(['command' => 'cache:clear']), $output);



        return Command::SUCCESS;
    }
}
