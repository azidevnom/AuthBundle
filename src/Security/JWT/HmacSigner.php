<?php

namespace MNC\Bundle\AuthBundle\Security\JWT;

/**
 * Class HmacSigner
 * @package MNC\Bundle\AuthBundle\Security\JWT
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class HmacSigner implements SignerInterface
{
    /**
     * The secret for HMAC signer.
     * @var string
     */
    private $secret;

    private static $header = ['alg' => 'HS256', 'typ' => 'JWT'];

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * This method signs a new Json Web Token with the passed payload.
     * Returns a base64 encoded JWT.
     * @param array $payload
     * @return string
     */
    public function sign(array $payload)
    {
        $header = base64_encode(json_encode(self::$header));
        $payload = base64_encode(json_encode($payload));
        $signature = $this->createSignature($header, $payload);
        return sprintf('%s.%s.%s', $header, $payload, $signature);
    }

    /**
     * This method verifies if a JWT is valid, and also if is not expired,
     * and other important validations.
     * @param string $signature
     * @param string $signedPayload
     * @return bool
     */
    public function verify(string $signature, string $signedPayload)
    {
        $hash = hash_hmac('sha256', $signedPayload, $this->secret);
        if ($hash !== $signature) {
            return false;
        }
        return true;
    }

    /**
     * @param $header
     * @param $payload
     * @return string
     */
    private function createSignature($header, $payload)
    {
        return base64_encode(hash_hmac('sha256',
            sprintf('%s.%s',
                $header,
                $payload
            ), $this->secret));
    }
}