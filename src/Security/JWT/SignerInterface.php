<?php

namespace MNC\Bundle\AuthBundle\Security\JWT;

/**
 * Interface SignerInterface
 * @package MNC\Bundle\AuthBundle\Security\JWT
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface SignerInterface
{
    /**
     * This method signs a new Json Web Token with the passed payload.
     * Returns a base64 encoded JWT.
     * @param array $payload
     * @return string
     */
    public function sign(array $payload);

    /**
     * This method verifies if a JWT is valid, ie, that has not been modified.
     * @param string $signature
     * @param string $signedPayload
     * @return null|array The decoded payload.
     */
    public function verify(string $signature, string $signedPayload);
}