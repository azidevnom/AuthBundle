<?php

namespace MNC\Bundle\AuthBundle\Security\JWT;

/**
 * Class JWTToken
 * @package MNC\Bundle\AuthBundle\Security\JWT
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class JwtToken implements JwtTokenInterface
{
    private $header = [];

    private $payload = [];

    private $signature;

    private $rawToken;

    public function __construct($header = [], $payload = [], $signature = null)
    {
        $this->header = $header;
        $this->payload = $payload;
        $this->signature = $signature;
    }

    /**
     * @inheritdoc
     */
    public static function parse(string $token)
    {
        [$header, $payload, $signature] = explode('.', $token);
        $header = json_decode(base64_decode($header), true);
        $payload = json_decode(base64_decode($payload), true);
        $instance =  new self($header, $payload, $signature);
        return $instance->setRawToken($token);
    }

    public function getSignedPortion()
    {
        return base64_encode(json_encode($this->header))
            .'.'
            .base64_encode(json_encode($this->payload));
    }

    /**
     * Returns the hashing algorithm used. The implementation must map the JWT
     * constants to the PHP ones using a static property.
     * @return string
     */
    public function getHashingAlgorithm()
    {
        return isset($this->header['alg']) ? $this->header['alg'] : null;
    }

    /**
     * Returns the timestamp when the token expires.
     * @return integer
     */
    public function getTtl()
    {
        return isset($this->payload['ttl']) ? $this->payload['ttl'] : null;
    }

    /**
     * Returns the username from the JWT.
     * @return string
     */
    public function getUsername()
    {
        return isset($this->payload['username']) ? $this->payload['username'] : null;
    }

    /**
     * Returns the roles defined on the JWT.
     * @return string
     */
    public function getRoles()
    {
        return isset($this->payload['roles']) ? $this->payload['roles'] : null;
    }

    /**
     * Returns the raw token if it was parsed from a rawToken.
     * @return string|null
     */
    public function getRawToken()
    {
        return $this->rawToken;
    }

    /**
     * Returns the signature part of the token.
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param $token
     * @return $this
     */
    public function setRawToken($token)
    {
        $this->rawToken = $token;
        return $this;
    }
}