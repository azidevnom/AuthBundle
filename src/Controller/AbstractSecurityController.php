<?php

namespace MNC\Bundle\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AbstractSecurityController
 * @package MNC\Bundle\AuthBundle\Controller
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
abstract class AbstractSecurityController extends Controller
{
    /**
     * @Route("/register", methods={"POST"})
     */
    public function registerAction()
    {

    }
}