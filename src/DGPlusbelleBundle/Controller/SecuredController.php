<?php

namespace DGPlusbelleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
/**
 * @Route("/secured")
 */
class SecuredController extends Controller
{

    /**
     * @Route("/login", name="plusbelle_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }
        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        //ladybug_dump($error);
        
        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository('DGPlusbelleBundle:Usuario')->findAll();
        
        
        return array(
            'last_username' => $lastUsername,
            'error' => $error,
            'users' => $users,
        );
        /*ladybug_dump($error);
        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'errors'         => $error,
        );*/
    }

    /**
     * @Route("/login_check", name="plusbelle_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
        
    }

    /**
     * @Route("/logout", name="plusbelle_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    
    
    
}