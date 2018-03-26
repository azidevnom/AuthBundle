<?php

namespace MNC\Bundle\AuthBundle\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SubscribableTrait
 * @package MNC\Bundle\AuthBundle\Model
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait SubscribableTrait
{
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $subscriptionExpiresAt;

    /**
     * @return \DateTime
     */
    public function getSubscriptionExpiresAt()
    {
        return $this->subscriptionExpiresAt;
    }

    /**
     * @param \DateTime $subscriptionExpiresAt
     * @return SubscribableTrait
     */
    public function setSubscriptionExpiresAt(\DateTime $subscriptionExpiresAt)
    {
        $this->subscriptionExpiresAt = $subscriptionExpiresAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscriptionActive()
    {
        return $this->getSubscriptionExpiresAt() > new \DateTime('now');
    }
}