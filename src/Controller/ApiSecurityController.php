<?php

namespace MNC\Bundle\AuthBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiSecurityController
 * @package MNC\Bundle\AuthBundle\Controller
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ApiSecurityController extends AbstractSecurityController
{
    /**
     * @Route("/token", methods={"POST"})
     * @param Request    $request
     * @return JsonResponse
     */
    public function getToken(Request $request)
    {
        $jwtManager = $this->get('auth.jwt_manager');
        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $token = $jwtManager->createTokenFromCredentials($username, $password);

        if ($token === null) {
            return JsonResponse::create(['message' => 'Invalid credentials.'], 401);
        }

        return JsonResponse::create([
            'token' => $token,
            'ttl' => (new \DateTime('+1 week'))->getTimestamp()
        ]);
    }
}