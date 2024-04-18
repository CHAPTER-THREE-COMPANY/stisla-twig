<?php

namespace ChapterThree\StislaTwigBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ChapterThreeStislaTwigBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}