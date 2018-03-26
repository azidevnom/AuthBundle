<?php

namespace MNC\Bundle\AuthBundle\Security\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface TokenExtractorInterface
 * @package MNC\Bundle\AuthBundle\Security\TokenExtractor
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface TokenExtractorInterface
{
    /**
     * @param Request $request
     * @return string The extracted token
     */
    public function extract(Request $request);
}