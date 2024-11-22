<?php

namespace ChapterThree\C3Bundle\Twig\Components\C3;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\Component\Form\FormView;

#[AsTwigComponent(template: '@C3/components/Fileuploader.html.twig')]
class Fileuploader
{
    public FormView $form;
}