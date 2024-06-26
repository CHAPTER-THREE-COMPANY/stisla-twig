<?php

namespace ChapterThree\C3Bundle\Command;

use ChapterThree\C3Bundle\C3Stisla;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'c3:config',
    description: 'Add a short description for your command',
)]
class C3ConfigCommand extends Command
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

        $io->ask("pause");
        C3Stisla::info();
        $io->ask("start");


        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        /*if ($input->getOption('option1')) {

        }*/

        $importmap = require('importmap.php');
        dump($importmap);
        $io->progressStart(100);
        for ($i = 0; $i < 100; ++$i) {
            $io->progressAdvance();
            usleep(10000);
        }
        $io->progressFinish();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
