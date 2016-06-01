<?php
/**
 * Created by PhpStorm.
 * User: fox
 * Date: 21.05.16
 * Time: 14:07
 */

namespace LazyBlog\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Class SecurityController
 */

class SecurityController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     *
     * @Route("/login")
     * @Template("AdminBundle:Security:login.html.twig")
     */
    public function loginAction(Request $request)
    {
//        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
//            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
//        } else {
//            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
//        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return array(
            'last_username' => $lastUsername,
            'error'         => $error,
        );
    }

    /**
     * Login check
     *
     * @Route("login_check")
     */
    public function loginCheckAction()
    {

    }
}