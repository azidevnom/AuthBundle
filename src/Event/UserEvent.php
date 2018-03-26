<?php

namespace MNC\Bundle\AuthBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AuthEvent
 * @package MNC\Bundle\AuthBundle\Event
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class UserEvent extends Event
{
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return UserEvent
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }
}