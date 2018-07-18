<?php

namespace ErposBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use ErposBundle\Entity\TblUser;
use AppBundle\Entity\TblBd;
use AppBundle\Entity\TblAdmin;	 
use ErposBundle\Entity\TblService;
use ErposBundle\Entity\TblGroupe;
use ErposBundle\Entity\TblGroupeUser;
use ErposBundle\Entity\TblPermission;	
use ErposBundle\Entity\TblRubrique;	
use ErposBundle\Entity\TblModule;
use ErposBundle\Form\Type\TblServiceType;
use ErposBundle\Form\Type\TblUserType;
use ErposBundle\Permission\Permission;
class UtilisateurController extends Controller
{
     
    public function serviceAction(Request $request){
		
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
		 
		$repository = $childEm->getRepository(TblService::class);
		$services = $repository->findAll();
		$TblService = new TblService();
		$form = $this->createForm(TblServiceType::class, $TblService);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
		    $childEm->persist($TblService);
			$childEm->flush();
			$this->addFlash("success", "Service est ajouté avec succès");
			return $this->redirectToRoute('services');
		}
		
		$Listeservices  = $this->get('knp_paginator')->paginate(
		$services,
		$request->query->get('page', 1),5);
        return $this->render('ErposBundle:Utilisateurs:liste_service.html.twig', array(
					'Listeservices' => $Listeservices,
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'serviceForm' => $form->createView(),
					'title' => 'Liste des services',
					'pemission' => $permission
		)); 
    }
	public function removeserviceAction($service){
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblService::class);
	    $servicenitity = $repository->find($service);
		$childEm->remove($servicenitity);
		$childEm->flush();
		$flashbag = $this->get('session')->getFlashBag();
		$this->addFlash("success", "Service est supprimé avec succée");
		return $this->redirectToRoute('services');
    
	}
	
	public function editserviceAction(Request $request, $id){
		
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		$repository = $childEm->getRepository(TblService::class);
		$servicenitity = $repository->find($id);
		$form = $this->createForm(TblServiceType::class, $servicenitity);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
					$childEm->flush();
					$this->addFlash("success", "Service est modifié avec succès");
					return $this->redirectToRoute('services');
		}
		return $this->render('ErposBundle:Utilisateurs:edit_service.html.twig', [
				'service' => $servicenitity,
				'editForm' => $form->createView(),
		]);
	
	}
	
	public function userAction(Request $request){
	 
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
		 
		$repository = $childEm->getRepository(TblUser::class);
		$utilisateurs = $repository->findAll();
		 
		
		$Listeutilisateurs  = $this->get('knp_paginator')->paginate(
		$utilisateurs,
		$request->query->get('page', 1),8);
        return $this->render('ErposBundle:Utilisateurs:liste_utlisateurs.html.twig', array(
					'Listeutilisateurs' => $Listeutilisateurs,
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'title' => 'Liste des utilisateurs',
					'pemission' => $permission
		)); 
    
	}
	
	public function ajoutUserAction(Request $request )
    {
	 
		 
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array(), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
        $session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child'); 
		$TblUser = new TblUser();
		$TblService = new TblService();
	    $TblGroupeUser  = new TblGroupeUser();
		$TblUser->getServiceId();
		$form = $this->createForm(TblUserType::class, $TblUser);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			 $data = $form->getData();
			 $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
			 
			 $TblUser->setStatus('USER');
			 $data = $form->getData();
			 $groupe = $form->get("groupe_id")->getData();		 
			 if(empty($data->getPhoto())){
				$TblUser->setPhoto($baseurl.'/img/user.png');
			 }
			$tblAdmin = new TblAdmin();
			$em = $this->getDoctrine()->getManager();
			$childEm->persist($TblUser);
			$TblGroupeUser->setGroupeId($groupe);
			$TblGroupeUser->setUserId($TblUser);
			$childEm->persist($TblGroupeUser);
			$childEm->flush();
			$tblAdmin->setIdClient($this->getUser()->getId());
			$tblAdmin->setIdUser($TblUser->getId());
			$encoder = $this->get('security.password_encoder');
			$encodedPassword = $encoder->encodePassword($tblAdmin, $data->password);
			$tblAdmin->setPassword($encodedPassword);
			$tblAdmin->setUsername($data->getUsername());
			$tblAdmin->setNumTel($data->getNumTel());
			$tblAdmin->setEmail($data->getEmail());
			$tblAdmin->setNomComplet($data->getNomComplet());
			$tblAdmin->setIsActive('1');
			$em->persist($tblAdmin);
			$em->flush();
			$this->addFlash("success", "Utilisateur est ajoutée avec succès");
			return $this->redirectToRoute('utilisateurs');
				
			
		}
	    return $this->render('ErposBundle:Utilisateurs:ajout_user.html.twig', [
			'clientForm' => $form->createView(),
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Ajouter un nouveau utilisateur'
		]);
    }
	public function removeutilisateurAction($user){
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblUser::class);
	    $userenitity = $repository->find($user);
		$groupe_id = $childEm->getRepository(TblGroupeUser::class)->findOneBy (['user_id' => $user]);
		$childEm->remove($userenitity);
		$childEm->remove($groupe_id);
		$childEm->flush();
		$em = $this->getDoctrine()->getManager();
		$utilisateur = $em->getRepository(TblAdmin::class)->findOneBy(['id_user' => $user]);
		
		$em->remove($utilisateur);
		$em->flush();
		$flashbag = $this->get('session')->getFlashBag();
		$this->addFlash("success", "utilisateur est supprimé avec succée");
		return $this->redirectToRoute('utilisateurs');
    
	}
	public function editutilisateurAction($user,Request $request){
		
		$current_route = $request->attributes->get('_route');
		 
 
		$url = $this->generateUrl($current_route, array('user' => $user), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblUser::class);
	    $userenitity = $repository->find($user);
	 
		$form = $this->createForm(TblUserType::class, $userenitity);
		$groupe_id = $childEm->getRepository(TblGroupeUser::class)->findOneBy (['user_id' => $userenitity]);
		if(!empty($groupe_id)){
			$groupe = $childEm->getRepository(TblGroupe::class)->find($groupe_id->getGroupeId());
			$form->get('groupe_id')->setData($groupe);
		}
		
		$form->handleRequest($request);
		 if ($form->isSubmitted() && $form->isValid()) {
			 $grObject = $form->get('groupe_id')->getData();
			 $groupe_user = $childEm->getRepository(TblGroupeUser::class)->findOneBy (['user_id' => $userenitity]);
			 
			if(!empty($groupe_id)){
			
				
				$groupe_user->setGroupeId($grObject);
			
			}else {
			
				 $TblGroupeUser = new TblGroupeUser();
				 $TblGroupeUser->setUserId($userenitity);
				 $TblGroupeUser->setGroupeId($grObject);
				 $childEm->persist($TblGroupeUser);
			}
			
		    $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $data = $form->getData();
 
			if(empty($data->getPhoto())){
				$userenitity->setPhoto($baseurl.'/img/user.png');
			}
			$em = $this->getDoctrine()->getManager();
			$utilisateur = $em->getRepository(TblAdmin::class)->findOneBy(['id_user' => $user]);
	
			$encoder = $this->get('security.password_encoder');
			$encodedPassword = $encoder->encodePassword($utilisateur, $data->password);
			$utilisateur->setPassword($encodedPassword);
			$utilisateur->setUsername($data->getUsername());
			$utilisateur->setNumTel($data->getNumTel());
			$utilisateur->setEmail($data->getEmail());
			$utilisateur->setNomComplet($data->getNomComplet());
 
            $em = $this->getDoctrine()->getManager();
			$childEm->flush();
			$em->flush();
			$this->addFlash("success", "Utilisateur est modifié avec succès");
			return $this->redirectToRoute('utilisateurs');
        }
		 return $this->render('ErposBundle:Utilisateurs:edit_utlisateur.html.twig', [
            'clientForm' => $form->createView(),
			'photo' => $userenitity->getPhoto(),
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Modifier utilisateur'
        ]);
   
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
	public function addLogoAction(Request $request){
	  	$imageresize = $this->container->get('image_resize');
		$cp_img_path = $request->request->get('cp_img_path');
 
		/*
			$image = $cp_img_path;
			$imageresize->load($cp_img_path);
			$imgX = intval($request->request->get['ic_x']);
			$imgY = intval($request->request->get['ic_y']);
			$imgW = intval($request->request->get['ic_w']);
			$imgH = intval($request->request->get['ic_h']);
			$imageresize->resize($imgW,$imgH,$imgX,$imgY);    
			$imageresize->save($image);
		*/
			return new Response('<img src="'.$cp_img_path.'?t='.time().'" class="img-thumbnail"/>' );
		
	} 
	public function viewAction(Request $request){
		$error       = false;
		$ds          = DIRECTORY_SEPARATOR; 
        $storeFolder = $request->server->get('DOCUMENT_ROOT').$request->getBasePath().'/upload/user';
		$baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

		if (!empty($_FILES) && $_FILES['file']['tmp_name']) {    
			$tempFile = $_FILES['file']['tmp_name'];

			$fileName = time().'_'.$_FILES['file']['name'];
			$allowedTypes = array(IMAGETYPE_JPEG); 
			$detectedType = exif_imagetype($tempFile);
			$error = !in_array($detectedType, $allowedTypes);
			$targetPath = $storeFolder . $ds;     
			$targetFile =  $targetPath. $fileName;
		 
			if(move_uploaded_file($tempFile,$targetFile)){
				$resp = $baseurl.'/upload/'.$fileName;
				//return $resp;
				return new Response(
				'<div class="cropping-image-wrap"><img src="'.$baseurl.'/upload/user/'.$fileName.'" class="img-thumbnail" id="crop_image"/></div>'
					);
			}
	  }
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
	public function ajoutGroupeAction(Request $request)
    {
		$permissions = array();
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array(), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$modules = $childEm->getRepository(TblModule::class)->findAll();
			foreach($modules as $key_module){
				$module = $childEm->getRepository(TblModule::class)->find($key_module);
				$rubrique = $childEm->getRepository(TblRubrique::class)->findBy(['module_id' => $module]);
				foreach($rubrique as $key => $rub){
					$permissions[$module->getNomModule().'-'.$module->getClasse().'-'.$module->getHref()][] = $rub;
			    }
			}
		
		 return $this->render('ErposBundle:Utilisateurs:ajouter_groupe.html.twig', [
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Ajouter Groupe',
			'permissions' => $permissions
        ]);
		
	} 
	public function addGroupeAction(Request $request){
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		$groupe =  $request->request->get('groupe');
	    
		$permission = $request->request->get('permission');
		
		$TblGroupe = new TblGroupe();
	    $TblGroupe->setNomGroupe($groupe);
		$childEm->persist($TblGroupe);
	    $childEm->flush();
		
		$tab = array();
		
		$test = array();
		if(!empty($permission)){
		foreach($permission as $row){
			$data = explode("-",$row);
		    $id = $data[0];
			$type = $data[1];
			if (array_key_exists($id,$tab)){
				$tab[$id][] = $type;
			}else {
				$tab[$id][] = $type;
			}
		}
 
		
		foreach($tab as $id => $row){
	        $test[] =  $id ;
			$TblPermission = new TblPermission();
			$rubrique = $childEm->getRepository(TblRubrique::class)->find($id);
			$TblPermission->setGroupeId($TblGroupe);
			$TblPermission->setRubriqueId($rubrique);
			foreach($row as $perm){
				
			   	if($perm == 'add'){ 
				   $TblPermission->setAddPermission(1);
				    
				}   
				else if($perm == 'edit'){ 
				  $TblPermission->setEditPermission(1);        
				  
				}  
				else  if($perm == 'supp'){
					$TblPermission->setSuppPermission(1);
					 
				} 
				 
			   
			}
			$childEm->persist($TblPermission);
	        $childEm->flush();
		}
		
		}
		
		//$permission = $request->request->get('permission');
		// print_r($request->request->get('permission'));
		return new Response('succeess');
	}
	public function groupesAction(Request $request,$msg=null){
		
		$msg =  $request->query->get('msg');
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
		
		$repository = $childEm->getRepository(TblGroupe::class);
		$groupes = $repository->findAll();
		if($msg == 'ajout'){
			$this->addFlash("success", "Groupe est ajouté avec succès");
			return $this->redirectToRoute('list_groupes');
			
		}else if($msg == 'edit'){
			$this->addFlash("success", "Groupe est modifié avec succès");
			return $this->redirectToRoute('list_groupes');
		}
		
		$Listegroupes = $this->get('knp_paginator')->paginate(
		$groupes,
		$request->query->get('page', 1),5);
        return $this->render('ErposBundle:Utilisateurs:liste_groupe.html.twig', array(
					'Listegroupes' => $Listegroupes,
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'title' => 'Liste des Groupes',
					'pemission' => $permission
		)); 
    
	}
	public function editgroupeAction($groupe,Request $request){
		
		
	 
		$permissions = array();
		$current_route = $request->attributes->get('_route');
		 
 
		$url = $this->generateUrl($current_route, array('groupe' => $groupe), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblGroupe::class);
	    $groupeenitity = $repository->find($groupe);
		$repository_permission_groupe = $childEm->getRepository(TblPermission::class);
		$permission_groupe = $repository_permission_groupe->findBy(['groupe_id' => $groupeenitity]);
		/*print_r($permission_groupe);
		exit;*/
		$modules = $childEm->getRepository(TblModule::class)->findAll();
			foreach($modules as $key_module){
				$module = $childEm->getRepository(TblModule::class)->find($key_module);
				$rubrique = $childEm->getRepository(TblRubrique::class)->findBy(['module_id' => $module]);
				foreach($rubrique as $key => $rub){
			 
				 
						foreach($permission_groupe as $key2 => $rub_perm){
						
						   if($rub_perm->getRubriqueId()->getId() == $rub->getId()){
								$rub->consul = 1;
						   }
						   if(($rub_perm->getRubriqueId()->getId() == $rub->getId()) && ($rub_perm->getAddPermission() == 1 )){
								$rub->add = 1;
						   }
							if(($rub_perm->getRubriqueId()->getId() == $rub->getId()) && ($rub_perm->getEditPermission() == 1 )){
								$rub->edit = 1;
						   }
						   if(($rub_perm->getRubriqueId()->getId() == $rub->getId()) && ($rub_perm->getSuppPermission() == 1 )){
								$rub->supp = 1;
						   }
						
						}
				
				 
					$permissions[$module->getNomModule().'-'.$module->getClasse().'-'.$module->getHref()][] = $rub;
			    }
				
			}
		/*print_r($permissions);
		exit;*/
		 return $this->render('ErposBundle:Utilisateurs:edit_groupe.html.twig', [
			'menu' => $menu_insterface,
			'header_menu' => $header_menu,
			'title' => 'Ajouter Groupe',
			'permissions' => $permissions,
			'current_groupe' => $groupeenitity,
			'permission_groupe' => $permission_groupe,
			'id_groupe' => $groupe
        ]);
   
    }
	public function editajaxGroupeAction(Request $request){
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		$groupe =  $request->request->get('groupe');
	    
		$permission = $request->request->get('permission');
	 
		
		$id_groupe = $request->request->get('id_groupe');

		$groupe = $request->request->get('groupe');
		$repository = $childEm->getRepository(TblGroupe::class);
	    $groupeenitity = $repository->find($id_groupe);

	    $groupeenitity->setNomGroupe($groupe);

	    $childEm->flush();
		
		$tab = array();
		
		$test = array();
		if(!empty($permission)){
			foreach($permission as $row){
				$data = explode("-",$row);
				$id = $data[0];
				$type = $data[1];
				if (array_key_exists($id,$tab)){
					$tab[$id][] = $type;
				}else {
					$tab[$id][] = $type;
				}
			}
		 
			$rubrique_permission = $childEm->getRepository(TblPermission::class)->findBy([
					'groupe_id' => $groupeenitity
			]);
			
			if(!empty($rubrique_permission)){
				foreach($rubrique_permission as $object){
					$childEm->remove($object);
					$childEm->flush();
					}
				}
			foreach($tab as $id => $row){
				$test[] =  $id ;
			 
				$rubrique = $childEm->getRepository(TblRubrique::class)->find($id);
							
				$TblPermission = new TblPermission();
				$TblPermission->setGroupeId($groupeenitity);
				$TblPermission->setRubriqueId($rubrique);
				foreach($row as $perm){
					
					if($perm == 'add'){ 
					   $TblPermission->setAddPermission(1);
						
					}   
					else if($perm == 'edit'){ 
					  $TblPermission->setEditPermission(1);        
					  
					}  
					else  if($perm == 'supp'){
						$TblPermission->setSuppPermission(1);
						 
					} 
					 
				   
				}
				$childEm->persist($TblPermission);
				$childEm->flush();
			}
		}
		return new Response('success');
	}
	public function removegroupeAction($groupe){
	
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child');
		
		$repository = $childEm->getRepository(TblGroupe::class);
	    $groupe_enitity = $repository->find($groupe);
		$groupe_user = $childEm->getRepository(TblGroupeUser::class)->findOneBy (['groupe_id' => $groupe_enitity]);

		$permission = $childEm->getRepository(TblPermission::class)->findBy (['groupe_id' => $groupe_enitity]);
		if(!empty($permission)) { 
		foreach($permission as $row){
			$childEm->remove($row);
		}}
		
		if(!empty($groupe_user)) { $childEm->remove($groupe_user); } 
		
		$childEm->remove($groupe_enitity);
		
		$childEm->flush();
	
		$flashbag = $this->get('session')->getFlashBag();
		$this->addFlash("success", "Groupe est supprimé avec succée");
		return $this->redirectToRoute('list_groupes');
    
	}
	
}
