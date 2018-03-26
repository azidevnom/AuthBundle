<?php

namespace MNC\Bundle\AuthBundle\Model;

/**
 * Interface SubscribableInterface
 * @package MNC\Bundle\AuthBundle\Model
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface SubscribableInterface
{
    /**
     * @return bool
     */
    public function isSubscriptionActive();

    /**
     * @return \DateTime
     */
    public function getSubscriptionExpiresAt();
}