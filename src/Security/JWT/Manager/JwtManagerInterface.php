<?php

namespace MNC\Bundle\AuthBundle\Security\JWT\Manager;

use MNC\Bundle\AuthBundle\Security\JWT\JwtTokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class JwtManagerInterface
 * @package MNC\Bundle\AuthBundle\Security\JWT\Manager
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface JwtManagerInterface
{
    /**
     * Creates a signed jwt token from
     * @param     $username
     * @param     $password
     * @param int $ttl
     * @return string
     */
    public function createTokenFromCredentials($username, $password, $ttl = 604800);

    /**
     * Returns an authenticated user from a raw jwt token.
     * The implementation must perform a ttl check, and also check if the token
     * has not been tampered.
     * @param $token
     * @return UserInterface
     */
    public function getUserFromToken(JwtTokenInterface $token);
}