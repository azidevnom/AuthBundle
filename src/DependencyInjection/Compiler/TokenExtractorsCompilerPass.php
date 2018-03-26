<?php

namespace MNC\Bundle\AuthBundle\DependencyInjection\Compiler;

use MNC\Bundle\AuthBundle\Security\TokenExtractor\ChainTokenExtractor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TokenExtractorsCompilerPass
 * @package MNC\Bundle\AuthBundle\DependencyInjection\Compiler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class TokenExtractorsCompilerPass implements CompilerPassInterface
{
    const TAG = 'auth.token_extractor';

    public function process(ContainerBuilder $container)
    {
        $chainExtractor = $container->getDefinition(ChainTokenExtractor::class);
        $extractors = $container->findTaggedServiceIds(self::TAG);

        $definitions = [];
        foreach ($extractors as $extractor => $tags) {
            $definitions[] = new Reference($extractor);
        }

        $chainExtractor->addArgument($definitions);
    }
}