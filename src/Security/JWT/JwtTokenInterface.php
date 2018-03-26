<?php

namespace MNC\Bundle\AuthBundle\Security\JWT;

/**
 * Interface JwtTokenInterface
 * @package MNC\Bundle\AuthBundle\Security\JWT
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface JwtTokenInterface
{
    /**
     * Factory method for parsing a JWT into an object.
     * @param string $rawToken
     * @return mixed
     */
    public static function parse(string $rawToken);

    /**
     * Returns the hashing algorithm used. The implementation must map the JWT
     * constants to the PHP ones using a static property.
     * @return string
     */
    public function getHashingAlgorithm();

    /**
     * Returns the timestamp when the token expires.
     * @return integer
     */
    public function getTtl();

    /**
     * Returns the username from the JWT.
     * @return string
     */
    public function getUsername();

    /**
     * Returns the raw token if it was parsed from a rawToken.
     * @return string|null
     */
    public function getRawToken();

    /**
     * Returns the signature part of the token.
     * @return string
     */
    public function getSignature();

    /**
     * Returns the signed portion of the token.
     * @return string
     */
    public function getSignedPortion();
}