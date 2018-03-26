<?php

namespace MNC\Bundle\AuthBundle\Security\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class ChainTokenExtractor
 * @package MNC\Bundle\AuthBundle\Security\TokenExtractor
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ChainTokenExtractor implements TokenExtractorInterface
{
    /**
     * @var TokenExtractorInterface[]
     */
    private $extractors;

    /**
     * ChainTokenExtractor constructor.
     * @param array $extractors
     */
    public function __construct(array $extractors = [])
    {
        $this->extractors = $extractors;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function extract(Request $request)
    {
        foreach ($this->extractors as $extractor) {
            $token = $extractor->extract($request);
            if ($token !== null) {
                return $token;
            }
        }
    }
}