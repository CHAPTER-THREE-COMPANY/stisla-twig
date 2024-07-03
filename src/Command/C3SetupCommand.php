<?php

namespace ChapterThree\C3Bundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

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
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->title("CHAPTER-THREE SUPER BUNDLE");

        $io->ask("初期設定を実行します[enter]");

        $filesystem = new Filesystem();
        $VENDOR = __DIR__.'/../../';
        $IMPORT = $VENDOR.'importmap.php';

        if (!$filesystem->exists('config/packages/chapter-three.yaml')) {
            $filesystem->copy($VENDOR.'Resources/config/chapter-three.yaml', 'config/packages/chapter-three.yaml');
        }else{
            $io->warning("config/packages/chapter-three.yaml is exist. does not copy");
        }
        if (!$filesystem->exists('config/packages/chapter-three_menu.yaml')) {
            $filesystem->copy($VENDOR.'Resources/config/chapter-three_menu.yaml', 'config/packages/chapter-three_menu.yaml');
        }else{
            $io->warning("config/packages/chapter-three_menu.yaml is exist. does not copy");
        }

        // Check Vendor Mode
        if (!$filesystem->exists($IMPORT)){
            $io->warning("symfony composer require chapter-three-three/c3-bundle を実行してください。");
            return Command::FAILURE;
        }

        $imp2 = include($IMPORT);
        $imp1 = include('importmap.php');
        $import = array_merge($imp1, $imp2);

        $filesystem->rename('importmap.php', "importmap.php.".(date("YmdHis")));

        $export = var_export($import, TRUE);
        $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [NULL, ']$1', ' => ['], $array);
        $export = join(PHP_EOL, array_filter(["["] + $array));
        $content ="<?php\n\n\nreturn ".$export.";";

        $filesystem->dumpFile('importmap.php', $content);


        $io->success('設定完了しました.');

        return Command::SUCCESS;
    }
}
