<?php

namespace ErposBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use ErposBundle\Entity\TblUser;
use AppBundle\Entity\TblBd;
use AppBundle\Entity\TblAdmin;	 
use ErposBundle\Entity\TblService;
use ErposBundle\Entity\TblGroupe;
use ErposBundle\Entity\TblGroupeUser;
use ErposBundle\Entity\TblPermission;	
use ErposBundle\Entity\TblRubrique;	
use ErposBundle\Entity\TblClient;	
use ErposBundle\Entity\TblModule;
use ErposBundle\Form\Type\TblClientAbonneType;
use ErposBundle\Form\Type\TblRechercheClientType;
use ErposBundle\Form\Type\TblUserType;
use ErposBundle\Permission\Permission;
use Doctrine\ORM\Query\ResultSetMapping;

class ClientController extends Controller
{
     
    public function listClientAction(Request $request){
		
		$current_route = $request->attributes->get('_route');
		 
		$url = $this->generateUrl($current_route, array(), true);
 
		$header_menu = $this->getHeaderMenu($url,$current_route);
		
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
	 
        $session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		
		$childEm = $this->container->get('doctrine')->getManager('child'); 
		$permission = $menu->getPermission($current_route);
		
		/*
		$application = new Application($this->get('kernel'));
	    $application->setAutoExit(false);
		$update = new ArrayInput(array(
			   'command' => 'doctrine:schema:update',
			   '--force' => true,
			   '--em' => 'child',
			));
 
			$output = new BufferedOutput();
 
			$application->run($update, $output);
 
		$content = $output->fetch();
		print_r($content);
		die();
		 */
		$repository = $childEm->getRepository(TblClient::class);
		$clients = $repository->findAll();
 

		$Listeclients  = $this->get('knp_paginator')->paginate(
		$clients,
		$request->query->get('page', 1),5);
	    $TblClient = new TblClient();
		$form = $this->createForm(TblRechercheClientType::class, $TblClient);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			
			$data    = $form->getData() ;
			$prenom  = $data->getPrenom();
			$nom     = $data->getNom();
			$adresse = $data->getAdresse();
			$ville	 = $data->getVille(); 
			$cp	 	 = $data->getCp();
			$pays	 = $data->getPays();
			$mobile	 = $data->getMobile();
			$tel 	 = $data->getNumtel();
			$fax 	 = $data->getFax();
			$email   = $data->getEmail();
			$societe = $data->getNomSociete();
			
			$params = array();
			
			if(!empty($nom)){
				$params['nom'] = $nom;
			}
			
			if($prenom){
				$params['prenom'] = $prenom;
			}
			
			if($adresse){
				$params['adresse'] = $adresse ;
			}
			
			if($ville){
				$params['ville'] = $ville ;
			}
			
			if($cp){
				$params['cp'] = $cp ;
			}
			
			if($pays){
				$params['pays'] = $pays ;
			}
			
			if($mobile){
				$params['mobile'] = $mobile ;
			}
			 
			if($fax){
				$params['fax'] = $fax ;
			}
			
			if($tel){
				$params['numtel'] = $tel ;
			}
			
			if($email){
				$params['email'] = $email ;
			}
			
			if($societe){
				$params['societe'] = $societe ;
			}
			
			$repository = $childEm->getRepository(TblClient::class);
			$clients = $repository->findBy($params);
			$Listeclients  = $this->get('knp_paginator')->paginate(
			$clients,
			$request->query->get('page', 1),5);
				return $this->render('ErposBundle:Client:liste_clients.html.twig', array(
					'Listeclients' => $Listeclients,
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'title' => 'Liste des clients',
					'pemission' => $permission,
					'recherche_form' => $form->createView(),
					'recherche' => true			
				)); 
			 
		}
        return $this->render('ErposBundle:Client:liste_clients.html.twig', array(
			'Listeclients' => $Listeclients,
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Liste des clients',
			'pemission' => $permission,
			'recherche_form' => $form->createView(),
			'recherche' => false					
		)); 
    }
	
	public function addClientAction(Request $request){
		
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array(), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
        $session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child'); 
		$permission = $menu->getPermission($current_route);
		$TblClient = new TblClient();
		$form = $this->createForm(TblClientAbonneType::class, $TblClient);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
		    $childEm->persist($TblClient);
			$childEm->flush();
			$this->addFlash("success", "Client est ajouté avec succès");
			return $this->redirectToRoute('Clients');
		}
		//TblClientAbonneType
		 return $this->render('ErposBundle:Client:ajouter_client.html.twig', array(
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Ajouter un nouveau client',
			'pemission' => $permission,
			 'clientForm' => $form->createView() 
		)); 
	}
	
	public function editclientAction(Request $request, $id){

		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array('id' => $id), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);

		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		$repository = $childEm->getRepository(TblClient::class);
		$clientenitity = $repository->find($id);
		$form = $this->createForm(TblClientAbonneType::class, $clientenitity);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
					$childEm->flush();
					$this->addFlash("success", "Client est modifié avec succès");
					return $this->redirectToRoute('Clients');
		}
		return $this->render('ErposBundle:Client:edit_client.html.twig', [
            'editForm' => $form->createView(),
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Modifier Client'
        ]);
	
	}
	public function removeabonneeAction(Request $request, $id){
		
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblClient::class);
	    $clientenitity = $repository->find($id);
 
		$childEm->remove($clientenitity);
 
		$childEm->flush();
  
		$flashbag = $this->get('session')->getFlashBag();
		$this->addFlash("success", "client est supprimé avec succée");
		return $this->redirectToRoute('Clients');
		
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

}
