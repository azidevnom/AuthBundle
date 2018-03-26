<?php

namespace MNC\Bundle\AuthBundle\Security\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class HeaderTokenExtractor
 * @package MNC\Bundle\AuthBundle\Security\TokenExtractor
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class HeaderTokenExtractor implements TokenExtractorInterface
{
    /**
     * The header name
     * @var string
     */
    private $headerName;
    /**
     * The prefix before the token
     * @var string
     */
    private $prefix;

    public function __construct($headerName = 'Authorization', $prefix = 'Bearer')
    {
        $this->headerName = $headerName;
        $this->prefix = $prefix;
    }

    /**
     * @param Request $request
     * @return mixed|null
     */
    public function extract(Request $request)
    {
        if (!$request->headers->has($this->headerName)) {
            return null;
        }

        $value = $request->headers->get($this->headerName);

        if (strpos($value, $this->prefix) === false ) {
            return null;
        }

        return  trim(str_replace($this->prefix, '', $value));
    }
}