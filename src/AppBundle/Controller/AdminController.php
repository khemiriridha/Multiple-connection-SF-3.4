<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\TblAdmin;
use AppBundle\Entity\TblBd;
use AppBundle\Form\Type\TblAdminType;
use AppBundle\Form\Type\TblBdType;
use AppBundle\Form\Type\TblClientType;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends Controller
{
    public function indexAction(Request $request )
    {
	   return $this->render('AppBundle:Admin:index.html.twig');
    }
	public function clientsAction(Request $request )
    {
	  $tblAdmin = new TblAdmin();
	   $form = $this->createForm(TblClientType::class, $tblAdmin);
	   $form->handleRequest($request);
	   if ($form->isSubmitted() && $form->isValid()) {
		 $data = $form->getData();
		 $clients = array();
		 //echo  $data->getNomComplet();
         $id = $form->get('id')->getData();
      	 $client = $this->getDoctrine()->getRepository('AppBundle:TblAdmin')->find($id);
		 $clients[] = $client;
	
		 $repositoryBd = $this->getDoctrine()->getRepository(TblBd::class);
	     $bases = $repositoryBd->findAll();
		 $Listeclients  = $this->get('knp_paginator')->paginate(
          $clients,
         $request->query->get('page', 1)/*le numéro de la page à afficher*/,
           10
		);
		 return $this->render('AppBundle:Admin:liste_clients.html.twig', array(
            'Listeclients' => $Listeclients,
			'bases' => $bases,
			'clientForm' => $form->createView()
          ) );
		   
	   }else {
	   $repository = $this->getDoctrine()->getRepository(TblAdmin::class);
	   $clients = $repository->findBy(
			array('status' => 'USER')
		);
	   //print_r($clients); exit;
	    $repositoryBd = $this->getDoctrine()->getRepository(TblBd::class);
	    $bases = $repositoryBd->findAll();
		
		$Listeclients  = $this->get('knp_paginator')->paginate(
        $clients,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          10
		);
	   return $this->render('AppBundle:Admin:liste_clients.html.twig', array(
            'Listeclients' => $Listeclients,
			'bases' => $bases,
			'clientForm' => $form->createView()
        ) );
	  
	   }
    }
	
	 
	public function searchClientAction(Request $request)
    {
	    $tousclients = array();
        $q = $request->query->get('term'); // use "term" instead of "q" for jquery-ui
		 $results = $this->getDoctrine()->getRepository('AppBundle:TblAdmin')
                  ->createQueryBuilder('o')
                  ->where('o.nomComplet LIKE :nomComplet')
                  ->setParameter('nomComplet','%'. $q.'%')
                  ->getQuery()
                  ->getResult();
		if(!empty($results)){	  
	    foreach ($results as $entity){
        
			$client['label'] = $entity->getNomComplet();
			$client['value'] = $entity->getId();
			$tousclients[] = $client;
        }}

        $response = new JsonResponse();
        $response->setData($tousclients);

        return $response;
     
    }
	public function ajoutClientAction(Request $request )
    {
	   $tblAdmin = new TblAdmin();
	   $form = $this->createForm(TblAdminType::class, $tblAdmin);
	   $form->handleRequest($request);
	   if ($form->isSubmitted() && $form->isValid()) {
           
		    $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $data = $form->getData();
			 
			$encoder = $this->get('security.password_encoder');
			$encodedPassword = $encoder->encodePassword($tblAdmin, $data->password);
			$tblAdmin->setPassword($encodedPassword);
			$tblAdmin->setStatus('USER');
			if(empty($data->getLogo())){
				$tblAdmin->setLogo($baseurl.'/img/client.jpg');
			}
            $em = $this->getDoctrine()->getManager();
			$em->persist($tblAdmin);
			$em->flush();
			$this->addFlash("success", "Client est ajouté avec succès");
			return $this->redirectToRoute('liste_clients');
        }
	   return $this->render('AppBundle:Admin:ajout_client.html.twig', [
            'clientForm' => $form->createView()
        ]);
    }
	public function ajouterBdAction(Request $request){

		 $tblBd = new TblBd();
         $tblAdmin = new TblAdmin();
		 $tblBd->getTblAdmin();
         $form = $this->createForm(TblBdType::class, $tblBd);
		 $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
			$dbPassword = $data->getPassword();
			$dbPasswordVoip = $data->getPassowrdVoip();
			if($dbPassword != $this->getParameter('database_password') && $dbPasswordVoip != $this->getParameter('database_password')){
				$this->addFlash("error", "Mot passe incorrect !!!");
				return $this->redirectToRoute('ajout_base');	
			}else {
			$em = $this->getDoctrine()->getManager();
			$em->persist($data);
            $em->flush();
			$childEm = $this->getDoctrine()->getManager('child');
			$connector = $this->container->get('application_connector');
			/***************************************/
				$dbName = $data->getBdName();
				$dbUser = $data->getLogin();
				$dbHost = $data->getServeur();
			/***************************************/
				$dbNameVoip = $data->getBdNameVoip();
				$dbUserVoip = $data->getLoginVoip();
				$dbHostVoip = $data->getServeurBdVoip();
			/***************************************/
			$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
			//$connector->resetConnectionsupport($dbNameVoip, $dbUserVoip, $dbPasswordVoip, $dbHostVoip, $reset = true);
			$application = new Application($this->get('kernel'));
			$application->setAutoExit(false);
			/***************************************************/
			$create = new ArrayInput(array(
			   'command' => 'doctrine:database:create',
			   '--connection' => 'child',
			));
			$update = new ArrayInput(array(
			   'command' => 'doctrine:schema:update',
			   '--force' => true,
			   '--em' => 'child',
			));
			/*****************************************************/
			/*$createsupport = new ArrayInput(array(
			   'command' => 'doctrine:database:create',
			   '--connection' => 'support',
			));
			$updatesupport = new ArrayInput(array(
			   'command' => 'doctrine:schema:update',
			   '--force' => true,
			   '--em' => 'support',
			));
			/*****************************************************/
			$output = new BufferedOutput();
			$application->run($create, $output);
			$application->run($update, $output);
			/*$application->run($createsupport, $output);
			$application->run($updatesupport, $output);*/
			$content = $output->fetch();
			print_r($content);
			die();
		  }

        }

		return $this->render('AppBundle:Admin:ajoutBaseClient.html.twig', array(
            'formbd' => $form->createView(),
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
        $storeFolder = $request->server->get('DOCUMENT_ROOT').$request->getBasePath().'/upload';
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
				'<div class="cropping-image-wrap"><img src="'.$baseurl.'/upload/'.$fileName.'" class="img-thumbnail" id="crop_image"/></div>'
					);
			}
	  }
	}
	
	public function removeclientAction($client){
		$repository = $this->getDoctrine()->getRepository(TblAdmin::class);
	    $client = $repository->find($client);
        $em = $this->getDoctrine()->getManager();
		$em->remove($client);
		$em->flush();
		$flashbag = $this->get('session')->getFlashBag();
		$this->addFlash("success", "Client est supprimé avec succée");
		return $this->redirectToRoute('liste_clients');
    }
	
	public function editclientAction($id,Request $request){
		$repository = $this->getDoctrine()->getRepository(TblAdmin::class);
	    $client = $repository->find($id);
	 
		$form = $this->createForm(TblAdminType::class, $client);
		$form->handleRequest($request);
		 if ($form->isSubmitted() && $form->isValid()) {
 
		    $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
            $data = $form->getData();
			 
			$encoder = $this->get('security.password_encoder');
			$encodedPassword = $encoder->encodePassword($client, $data->password);
			$client->setPassword($encodedPassword);
			$client->setStatus('USER');
			if(empty($data->getLogo())){
				$client->setLogo($baseurl.'/img/client.jpg');
			}
            $em = $this->getDoctrine()->getManager();
			//$em->persist($client);
			$em->flush();
			$this->addFlash("success", "Client est modifié avec succès");
			return $this->redirectToRoute('liste_clients');
        }
		 return $this->render('AppBundle:Admin:edit_client.html.twig', [
            'clientForm' => $form->createView(),
			'logo' => $client->getLogo()
        ]);
        // $em = $this->getDoctrine()->getManager();
		// $em->remove($client);
		// $em->flush();
		// $flashbag = $this->get('session')->getFlashBag();
		// $this->addFlash("success", "Client est supprimé avec succée");
		// return $this->redirectToRoute('liste_clients');
    }
	
	public function listebasesAction(Request $request){
		$repository = $this->getDoctrine()->getRepository(TblBd::class);
	    $Bases = $repository->findAll();
		$Listebases  = $this->get('knp_paginator')->paginate(
        $Bases,
        $request->query->get('page', 1)/*le numéro de la page à afficher*/,
          8
		);
	    return $this->render('AppBundle:Admin:liste_base.html.twig',
		array('bases' => $Listebases));

    }
	
}
