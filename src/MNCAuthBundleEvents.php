<?php

namespace MNC\Bundle\AuthBundle;

/**
 * Class MNCAuthBundleEvents
 * @package MNC\Bundle\AuthBundle
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class MNCAuthBundleEvents
{
    /**
     * Fired after a new user is registered.
     * Hook into this event to perform aditional checks or modify the user.
     * This auth bundle uses this event to send a confirmation email.
     * You can change the confirmation email by subscribing to this event with a
     * higher priority and stop propagation.
     * Also, you can skip this confirmation email altogether and proceed to confirm
     * the user automatically.
     * @class MNC\Bundle\AuthBundle\Event\UserEvent
     */
    const USER_REGISTERED = 'auth.on_user_registered';

    /**
     * Fired when the registration email of a user has been confirmed.
     * Hook into this event to perform aditional checks or modify the user.
     * This auth bundle uses this event to send a welcome email.
     * You can change the welcome email by subscribing to this event with a
     * higher priority and stop propagation.
     * @class MNC\Bundle\AuthBundle\Event\UserEvent
     */
    const USER_EMAIL_CONFIRMED = 'auth.on_user_email_confirmed';

    /**
     * Fired after a password change request has been issued.
     * Hook into this event to perform aditional steps, like sending a notification
     * to the user.
     * @class @class MNC\Bundle\AuthBundle\Event\UserEvent
     */
    const PASSWORD_CHANGE_REQUESTED = 'auth.on_password_change_requested';

    /**
     * Fired after a password change has been successfully completed.
     * Hook into this event to perform aditional steps, like sending a notification
     * to the user.
     * @class MNC\Bundle\AuthBundle\Event\UserEvent
     */
    const PASSWORD_CHANGED = 'auth.on_password_changed';

    /**
     * Fired just before the jwt token is created.
     * Hook into this event to modify the payload of the jwt token.
     * @class MNC\Bundle\AuthBundle\Event\TokenEvent
     */
    const TOKEN_CREATED = 'auth.on_token_created';

    /**
     * Fired just after the user has been authenticated and Symfony's auth token
     * has been created.
     * Hook into this event perform aditional steps, like modifying Symfony's
     * Security token.
     * @class MNC\Bundle\AuthBundle\Event\AuthTokenEvent
     */
    const USER_AUTHENTICATED = 'auth.on_user_authenticated';
}