<?php

namespace MNC\Bundle\AuthBundle\Security;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class ApiAuthenticationException
 * @package MNC\Bundle\AuthBundle\Security
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApiAuthenticationException extends AuthenticationException
{
    /**
     * @return ApiAuthenticationException
     */
    public static function modifiedToken()
    {
        return new self('The authorization token has been tampered.');
    }

    /**
     * @return ApiAuthenticationException
     */
    public static function noAuthorizationTokenFound()
    {
        return new self('No authorization token found.');
    }

    /**
     * @return ApiAuthenticationException
     */
    public static function expiredToken()
    {
        return new self('The token has expired');
    }

    /**
     * @return ApiAuthenticationException
     */
    public static function expiredTokenByRoles()
    {
        return new self('You token has been expired due to Role changes.');
    }
}