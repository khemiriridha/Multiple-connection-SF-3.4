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

class ConfigurationController extends Controller
{
    public function menuAction(Request $request,$route )
    {
        $user = $this->getUser();
		if(in_array('ROLE_ADMIN',$user->getRoles())){
			return $this->render('AppBundle:Configuration:admin_menu.html.twig',
			    array(
				   'user' => $user,
				   'current_route' => $route
				)
			);
		}else {
			return $this->render('AppBundle:Configuration:client_menu.html.twig',
			   array('user' => $user)
			);
		}
    }
	
	
	public function headerAction(Request $request )
    {
	   return $this->render('AppBundle:Configuration:header.html.twig');
    }
	 
	
}
