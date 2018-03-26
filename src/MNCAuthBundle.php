<?php

namespace MNC\Bundle\AuthBundle;

use MNC\Bundle\AuthBundle\DependencyInjection\Compiler\TokenExtractorsCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MNCAuthBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TokenExtractorsCompilerPass());
        parent::build($container);
    }
}
