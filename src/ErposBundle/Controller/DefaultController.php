<?php

namespace ErposBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ErposBundle\Entity\TblUser;
use AppBundle\Entity\TblBd;
use AppBundle\Entity\TblAdmin;	
use ErposBundle\Entity\TblGroupe;
use ErposBundle\Entity\TblGroupeUser;
use ErposBundle\Entity\TblPermission;	
use ErposBundle\Entity\TblRubrique;	
use ErposBundle\Entity\TblModule;	

class DefaultController extends Controller
{
     
    public function indexAction(Request $request){
	 
		$current_route = $request->attributes->get('_route');
		$menu = $this->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array(), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		
		
        return $this->render('ErposBundle:Default:index.html.twig', array(
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					
				)); 
    }
	
	 public function ajouter_utilisateurAction(Request $request){
	 
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array(), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		
		
        return $this->render('ErposBundle:Default:index.html.twig', array(
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					
				)); 
    }
	
	public function getHeaderMenu($url,$route){
	   $url =  str_replace('system','Erpos',$url);
	   $list = explode('/', $url);
	   $list_url = array_slice($list,1);
	   $breadcrumb = array();
	   $last_key = count($list_url);
		foreach(array_slice($list,1) as $key => $val){
			$link = new \stdClass();
			$link->nom = $val;
			if($key==0){ $link->href = 'system'; $link->cls = 'inactive';} 
			else if($key == $last_key-1) {$link->href = $route;$link->cls = 'active';}
			else { $link->href = '#';$link->cls = 'inactive'; }
			$breadcrumb[] = $link;
		}
		return $breadcrumb;
	}
	public function adduserAction()
    {
		$user = $this->getUser();
		$type = $user->getIdClient();
	    $client = $user->getId();
	 
		$bd = $this->getDoctrine()->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $client]);
		if ($bd) {
			 
					$childEm = $this->getDoctrine()->getManager('child');
					$dbName = $bd->getBdName();
					$dbUser = $bd->getLogin();
					$dbPassword = $bd->getPassword();
					$dbHost = $bd->getServeur();
					$connector = $this->container->get('application_connector');
					$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
					//$users = $childEm->getRepository(TblUser::class)->findAll();
					$childuser = new \ErposBundle\Entity\TblUser;
					$user = new \AppBundle\Entity\TblAdmin;
					
					$childuser->setUsername('test');
					$childuser->setPassword('123');
					$childuser->setLevel('1');
					$childuser->setNumTel('16263262');
					$childuser->setEmail('sqfdsf@dsfds.fr');
					$childuser->setMobile('16263262');
					$childuser->setStatus('USER');
					
					$childEm->persist($childuser);
					$childEm->flush();
					$encoder = $this->get('security.password_encoder');
					$encodedPassword = $encoder->encodePassword($user, '123');
					$user->setPassword($encodedPassword);
					$user->setUsername('test');
					 
					$user->setLevel('1');
					$user->setStatus('USER');
					$user->setIsActive('1');
					$user->setIdClient($client);
					$em = $this->getDoctrine()->getEntityManager();
					$em->persist($user);
					$em->flush();
					
					
					
				echo("Log In Denied: Wrong password for User #" . $bd->getBdName());
				die();
				}
	}
	
}
