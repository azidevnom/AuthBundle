<?php

namespace MNC\Bundle\AuthBundle\Security\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class QueryParamTokenExtractor
 * @package MNC\Bundle\AuthBundle\Security\TokenExtractor
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class QueryParamTokenExtractor implements TokenExtractorInterface
{
    /**
     * The query param name.
     * @var string
     */
    private $paramName;

    /**
     * QueryParamTokenExtractor constructor.
     * @param $paramName
     */
    public function __construct($paramName = 'token')
    {
        $this->paramName = $paramName;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function extract(Request $request)
    {
        if (!$request->query->has($this->paramName)) {
            return null;
        }

        return $request->query->get($this->paramName);
    }

}