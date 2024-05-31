<?php

namespace ChapterThree\C3Bundle;

use ChapterThree\C3Bundle\DependencyInjection\C3Extension;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use \Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Runtime\Symfony\Component\Console\Input\InputInterfaceRuntime;

class C3Bundle extends AbstractBundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new C3Extension();
    }

    function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Chapter three');

        $io->writeln('<info>C3</info>');
        $io->ask('What is the name of the chapter three?');
    }
    /*    public function getPath(): string
        {
            return dirname(__DIR__);
        }*/
}