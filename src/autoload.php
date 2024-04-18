<?php

use Symfony\Config\TwigConfig;

return static function (TwigConfig $twig) {
    // ...

    $twig->path('email/default/templates', null);
    $twig->path('backend/templates', 'admin');
};
