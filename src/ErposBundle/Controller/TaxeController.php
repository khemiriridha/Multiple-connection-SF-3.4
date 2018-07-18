<?php

namespace ErposBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TblAdmin;	 
use ErposBundle\Entity\TblGroupe;
use ErposBundle\Entity\TblGroupeUser;
use ErposBundle\Entity\TblPermission;	
use ErposBundle\Entity\TblRubrique;	
use ErposBundle\Entity\TblModule;	
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use ErposBundle\Entity\tbl_taxe;

class TaxeController extends Controller
{
     
   
	
	
	
    
	
	public function settingAction(Request $request){
	 
		$current_route = $request->attributes->get('_route');
		$menu = $this->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array());
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$idclient = $user->getIdClient();
		
		
		if(!$idclient){
			
			
			$client = $this->getDoctrine()->getRepository('AppBundle:TblAdmin')->find($user->getId());
			//var_dump( $client ); exit;
			
		
	    
		    //$TblAdmin = new TblAdmin();
	  
		   //$form = $this->createForm(TblAdminType::class, $client);
		   $form = $this->createFormBuilder($client)
			
			->add('numTel',TextType::class )
			->add('mobile', TextType::class )
			->add('fax', TextType::class )
			->add('email', TextType::class )
			->add('siret', TextType::class )
			->add('nTvaIntracommunautaire', TextType::class )
			->add('formeJuridique', TextType::class )
			->add('capitalSocial', TextType::class )
			->add('rcs', TextType::class )
			->add('cp', TextType::class )
			->add('adresse', TextType::class )
			->add('ville', TextType::class )
			->add('site', TextType::class )
			->add('pays', TextType::class )
			->add('save', SubmitType::class)
			->getForm();
		   
		   
		   $form->handleRequest($request);
		   if ($form->isSubmitted() && $form->isValid()) {
			   
				$data = $form->getData();
				$em = $this->container->get('doctrine')->getManager(); 
				$em->persist($data);
				$em->flush();
				//$this->addFlash("success", " ");
				return $this->redirectToRoute('setting'); 
			}
			
			 $form_user = $this->createFormBuilder($client)
			
					->add('username',TextType::class )
					->add('password', TextType::class )
					->add('service', TextType::class )
					->add('idEquipe', TextType::class )
					->add('nomComplet', TextType::class )
					->add('logo', HiddenType::class )
					/*->add('service_id', EntityType::class, array(
							'class' => 'ErposBundle\Entity\TblService',
							'choice_label' => 'nom_service',
							'query_builder' => function (EntityRepository $er) {
										

										return $er->createQueryBuilder('u')
										},
						))
					*/
					->add('save', SubmitType::class)
					->getForm();
		            $form_user->handleRequest($request);
					   if ($form_user->isSubmitted() && $form_user->isValid()) {
						   
							$data = $form_user->getData();
							 //var_dump($data); exit;
						}
			
					$session = $this->get('session');
					$connector = $this->container->get('application_connector');
					$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
					
					$childEm = $this->container->get('doctrine')->getManager('child'); 
					$repository = $childEm->getRepository(tbl_taxe::class);
					$taxe = $repository->findAll();
			//var_dump($taxe);exit;
			    $form_facture = $this->createFormBuilder()
			
					->add('tva',TextType::class )
					->add('note_en_bas',TextareaType::class )
					->add('save', SubmitType::class)
					->getForm();
			       $form_facture->handleRequest($request);
				   if ($form_facture->isSubmitted() && $form_facture->isValid()) {
					   
						$data = $form_facture->getData();
						// var_dump($data); exit;
					}
			    $tbl_taxe =new tbl_taxe();		
			    $form_add_taxe = $this->createFormBuilder($tbl_taxe)
			
					->add('titre',TextType::class )
					->add('type',ChoiceType::class , array(
									'choices'  => array(
										'Valeur fixe' => 'fixe',
										'Pourcentage' => 'pourcentage',
									),
								))
					->add('inclure',ChoiceType::class , array(
									'choices'  => array(
									    'Prix total TTC' => 'TTC',
										'Prix total HT' => 'HT',
										
									),
								))
					->add('valeur',TextType::class )
					->add('save', SubmitType::class)
					->getForm();
			       $form_add_taxe->handleRequest($request);
				   if ($form_add_taxe->isSubmitted() && $form_add_taxe->isValid()) {
					   
						$data_taxe = $form_add_taxe->getData();
						$childEm = $this->container->get('doctrine')->getManager('child'); 
						
                        //var_dump($data_taxe);exit;
						$childEm->persist($data_taxe);
						$childEm->flush();
						
						return $this->redirectToRoute('setting'); 
					}
			
			return $this->render('ErposBundle:Utilisateurs:setting.html.twig', array(
					
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'clientForm' => $form->createView(),
					'form_user' => $form_user->createView(),
					'form_facture' => $form_facture->createView(),
					'form_add_taxe' => $form_add_taxe->createView(),
					'taxe' => $taxe,
					
		    )); 
		}else{
			
			return $this->redirectToRoute('services');
		}
      
        
         
    }
	
	public function edit_taxeAction($id,Request $request){
	 
		$current_route = $request->attributes->get('_route');
		$menu = $this->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
		$current_route = $request->attributes->get('_route');
		$url = $this->generateUrl($current_route, array('id' => $id), true);
		$header_menu = $this->getHeaderMenu($url,$current_route);
		$menu = $this->container->get('menu_utilisateur');
		$menu_insterface = $menu->getMenu();
       
	   $session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		
		$childEm = $this->container->get('doctrine')->getManager('child'); 
		$repository = $childEm->getRepository(tbl_taxe::class);
		$tbl_taxe = $repository->find($id);
		
		$form_add_taxe = $this->createFormBuilder($tbl_taxe)
			
			->add('titre',TextType::class )
			->add('type',ChoiceType::class , array(
							'choices'  => array(
								'Valeur fixe' => 'fixe',
								'Pourcentage' => 'pourcentage',
							),
						))
			->add('inclure',ChoiceType::class , array(
							'choices'  => array(
								'Prix total TTC' => 'TTC',
								'Prix total HT' => 'HT',
								
							),
						))
			->add('valeur',TextType::class )
			->add('save', SubmitType::class)
			->getForm();
		   $form_add_taxe->handleRequest($request);
		   if ($form_add_taxe->isSubmitted() && $form_add_taxe->isValid()) {
		   
						$data_taxe = $form_add_taxe->getData();
						$childEm = $this->container->get('doctrine')->getManager('child'); 
						$childEm->persist($data_taxe);
						$childEm->flush();
						
						return $this->redirectToRoute('setting'); 
		   
		   }
					   
        return $this->render('ErposBundle:Utilisateurs:edit_taxe.html.twig', array(
					
					'menu' => $menu_insterface,
					'header_menu' => $header_menu,
					'form_add_taxe' => $form_add_taxe->createView(),
					'title' => 'Modifier Taxe'
		)); 
         
    }
	public function remove_taxeAction($id){
	 
		$session = $this->get('session');
		$connector = $this->container->get('application_connector');
		$connector->resetConnectionchild($session->get('dbName'), $session->get('dbUser'), $session->get('dbPassword'), $session->get('dbHost'), $reset = true);
		$childEm = $this->container->get('doctrine')->getManager('child'); 
		$repository = $childEm->getRepository(tbl_taxe::class);
		$client = $repository->find($id);
		$childEm->remove($client);
		$childEm->flush();
		
		//$this->addFlash("success", " Service a été supprimé !! ");
        return $this->redirectToRoute('setting'); 
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
