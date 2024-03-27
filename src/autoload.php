<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
    $container->extension("twig", [
        "'paths.'%kernel.project_dir%/vendor/chapter-three-company/stisla-twig/Resources/templates''" => 'c3'
    ]);
};