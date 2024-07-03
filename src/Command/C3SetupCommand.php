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

        $io->ask("初期設定方法を説明します[enter]");

        $filesystem = new Filesystem();

        #if (!$filesystem->exists('vendor/chapter-three-three/c3-bundle/importmap.php')){
        if (!$filesystem->exists('importmap2.php')){
            $io->warning("symfony composer require chapter-three-three/c3-bundle を実行してください。");
            return Command::FAILURE;
        }

        #$imp1 = include('vendor/chapter-three-three/c3-bundle/importmap.php');
        $imp1 = include('importmap2.php');
        $imp2 = include('importmap.php');
        $import = array_merge($imp1, $imp2);

        $filesystem->rename('importmap.php', "importmap.php.".(date("Ymd")));

        $filesystem->dumpFile('importmap.php', "<?php\nreturn ".var_export($import, true).";");

        $io->success('上記利用方法を設定してください.');

        return Command::SUCCESS;
    }
}
