<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

                return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     *
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR,
            $session->get(SecurityContext::AUTHENTICATION_ERROR));
        return $this->render(':default:login.html.twig', array(
            'error' => $error,
            'last_username' => $session->get(SecurityContext::LAST_USERNAME)
            )
        );
    }

    /**
     * @Route("/prueba", name="prueba")
     */
    public function pruebaAction()
    {
        return $this->render('default/prueba.html.twig');
    }
}
