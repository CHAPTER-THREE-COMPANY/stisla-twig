<?php

namespace ChapterThree\C3Bundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_method_exists', [$this, 'isMethodExists'])
        ];
    }

    public function isMethodExists($object, $method)
    {
        return method_exists($object, $method);
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('is_active', [$this, 'is_active']),
            new TwigFilter('safe', [$this, 'safe']),

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function is_active($arg1, $arg2, $arg3)
    {
        $func = function($arg1, $arg2, $arg3){
            $arg2 = str_replace("/", "\/", $arg2);
            if (preg_match("/^".$arg2."/", $arg3)) {
                return $arg1;
            }else{
                return " ";
            }
        };
        if (is_array($arg2)){
            $ret = " ";
            foreach ($arg2 as $value){
                if ($func($arg1, $value['url'], $arg3) == $arg1) {
                    $ret = $arg1;
                    break;
                }
            }
            return $ret;
        }else{
            return $func($arg1, $arg2, $arg3);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safe($arg)
    {
        if (isset($arg))
            return $arg;
        else
            return '';
    }

}
