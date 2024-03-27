<?php

require_once '../vendor/autoload.php';


return static function (TwigConfig $twig) {
    // ...

    $twig->path('email/default/templates', null);
    $twig->path('backend/templates', 'admin');
};
