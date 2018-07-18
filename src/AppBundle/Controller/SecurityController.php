<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use ErposBundle\Entity\Task;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\TblAdmin;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function indexAction(Request $request)
    {
		
        $authenticationUtils = $this->get('security.authentication_utils');
		
		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername();
		
		//var_dump($authenticationUtils); die();
		return $this->render('AppBundle:Login:index.html.twig', array(
			'last_username' => $lastUsername,
			'error'         => $error,
		));
    }
}
