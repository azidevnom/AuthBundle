<?php

namespace MNC\Bundle\AuthBundle\Security\Guard;

use MNC\Bundle\AuthBundle\Event\AuthTokenEvent;
use MNC\Bundle\AuthBundle\MNCAuthBundleEvents;
use MNC\Bundle\AuthBundle\Security\ApiAuthenticationException;
use MNC\Bundle\AuthBundle\Security\JWT\JwtToken;
use MNC\Bundle\AuthBundle\Security\JWT\Manager\JwtManagerInterface;
use MNC\Bundle\AuthBundle\Security\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class AbstractApiAuthenticator
 * @package MNC\Bundle\AuthBundle\Security\Guard
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApiAuthenticator implements AuthenticatorInterface
{
    /**
     * @var TokenExtractorInterface
     */
    private $tokenExtractor;
    /**
     * @var JwtManagerInterface
     */
    private $jwtManager;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        TokenExtractorInterface $tokenExtractor,
        JwtManagerInterface $jwtManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->tokenExtractor = $tokenExtractor;
        $this->jwtManager = $jwtManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        return $request->headers->has('Authorization') OR $request->query->has('token');
    }

    /**
     * @inheritdoc
     */
    public function getCredentials(Request $request)
    {
        $token = $this->tokenExtractor->extract($request);
        if ($token === null) {
            throw ApiAuthenticationException::noAuthorizationTokenFound();
        }
        return JwtToken::parse($token);
    }

    /**
     * @inheritdoc
     */
    public function getUser($token, UserProviderInterface $userProvider)
    {
        return $this->jwtManager->getUserFromToken($token);
    }

    /**
     * @inheritdoc
     */
    public function checkCredentials($token, UserInterface $user)
    {
        return true;
    }

    public function createAuthenticatedToken(UserInterface $user, $providerKey)
    {
        $token =  new PostAuthenticationGuardToken(
            $user,
            $providerKey,
            $user->getRoles()
        );

        $event = $this->eventDispatcher->dispatch(
            MNCAuthBundleEvents::USER_AUTHENTICATED,
            new AuthTokenEvent($user, $token)
        );

        return $event->getAuthToken();
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return JsonResponse::create([
            'type' => 'error/auth',
            'title' => 'Authentication error',
            'status' => 401,
            'detail' => $exception->getMessage(),
        ], 401);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    /**
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return JsonResponse::create([
            'type' => 'error/auth',
            'title' => 'Authentication error',
            'status' => 401,
            'detail' => 'This resource needs authentication. Please request a token.',
            '_links' => [
                'token' => '/token',
                'method' => 'POST',
                'params' => ['_username', '_password']
            ]
        ], 401);
    }
}