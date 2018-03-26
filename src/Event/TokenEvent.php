<?php

namespace MNC\Bundle\AuthBundle\Event;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class TokenEvent
 * @package MNC\Bundle\AuthBundle\Event
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class TokenEvent extends UserEvent
{
    private $payload;

    public function __construct(UserInterface $user, array $payload)
    {
        $this->payload = $payload;
        parent::__construct($user);
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     * @return TokenEvent
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;
        return $this;
    }
}