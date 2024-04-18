<?php

namespace ChapterThree\Stisla;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StislaTwigBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}