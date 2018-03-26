<?php

namespace MNC\Bundle\AuthBundle\Event;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AuthTokenEvent
 * @package MNC\Bundle\AuthBundle\Event
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class AuthTokenEvent extends UserEvent
{
    /**
     * @var TokenInterface
     */
    private $authToken;

    public function __construct(UserInterface $user, TokenInterface $authToken)
    {
        parent::__construct($user);
        $this->authToken = $authToken;
    }

    /**
     * @return TokenInterface
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param TokenInterface $authToken
     * @return AuthTokenEvent
     */
    public function setAuthToken(TokenInterface $authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }
}