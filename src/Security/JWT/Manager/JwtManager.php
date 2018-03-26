<?php

namespace MNC\Bundle\AuthBundle\Security\JWT\Manager;

use MNC\Bundle\AuthBundle\Event\TokenEvent;
use MNC\Bundle\AuthBundle\MNCAuthBundleEvents;
use MNC\Bundle\AuthBundle\Security\ApiAuthenticationException;
use MNC\Bundle\AuthBundle\Security\JWT\JwtTokenInterface;
use MNC\Bundle\AuthBundle\Security\JWT\SignerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class JwtManager
 * @package MNC\Bundle\AuthBundle\Security\JWT\Manager
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class JwtManager implements JwtManagerInterface
{
    /**
     * @var UserProviderInterface
     */
    private $provider;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var SignerInterface
     */
    private $signer;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;
    /**
     * @var array
     */
    private $config = [];

    public function __construct(
        UserProviderInterface $provider,
        UserPasswordEncoderInterface $encoder,
        SignerInterface $signer,
        EventDispatcherInterface $eventDispatcher,
        array $config = []
    ) {
        $this->provider = $provider;
        $this->encoder = $encoder;
        $this->signer = $signer;
        $this->eventDispatcher = $eventDispatcher;
        $this->config = $config;
    }

    public function createTokenFromCredentials($username, $password, $ttl = 604800)
    {
        try {
            $user = $this->provider->loadUserByUsername($username);
        } catch (AuthenticationException $exception) {
            return null;
        }

        if (!$this->encoder->isPasswordValid($user, $password)) {
            return null;
        }

        $event = new TokenEvent($user, [
            'username' => $user->getUsername(),
            'ttl' => time() + $ttl,
        ]);

        $event = $this->eventDispatcher->dispatch(MNCAuthBundleEvents::TOKEN_CREATED, $event);

        return $this->signer->sign($event->getPayload());
    }

    public function getUserFromToken(JwtTokenInterface $token)
    {
        $result = $this->signer->verify($token->getSignature(), $token->getSignedPortion());

        if ($result !== false) {
            ApiAuthenticationException::modifiedToken();
        }

        if ($token->getTtl() < time()) {
            ApiAuthenticationException::expiredToken();
        }

        return $this->provider->loadUserByUsername($token->getUsername());
    }
}