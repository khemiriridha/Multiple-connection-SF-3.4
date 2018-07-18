<?php
namespace ErposBundle\Services;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface; 
use Symfony\Component\DependencyInjection\ContainerInterface; 

use ErposBundle\Entity\TblUser;
use AppBundle\Entity\TblBd;
use AppBundle\Entity\TblAdmin;	
use ErposBundle\Entity\TblGroupe;
use ErposBundle\Entity\TblGroupeUser;
use ErposBundle\Entity\TblPermission;	
use ErposBundle\Entity\TblRubrique;	
use ErposBundle\Entity\TblModule;	
use ErposBundle\Permission\Permission;	
class MenuUtilisateur
{
  protected $em;
  protected $tokenStorage;
  protected $container;
  private $session;
  public function __construct(EntityManagerInterface $em,TokenStorageInterface $tokenStorage,ContainerInterface $container)
  {
    $this->em = $em;
	$this->tokenStorage = $tokenStorage;
	$this->container = $container;
 
  }

  public function getMenu()
  {
	$user = $this->tokenStorage->getToken()->getUser();
	$type = $user->getIdClient();
	$menu_permissions = array();
        if($type){
			/*********************** User  *******************************************************/
		    $bd = $this->em->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $type]);
		    $dbName = $bd->getBdName();
			$dbUser = $bd->getLogin();
			$dbPassword = $bd->getPassword();
			$dbHost = $bd->getServeur();
			$connector = $this->container->get('application_connector');
			$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
			$childEm = $this->container->get('doctrine')->getManager('child');
			$userconn = $childEm->getRepository(TblUser::class)->find($user->getIdUser());
			 
			$groupe_id = $childEm->getRepository(TblGroupeUser::class)->findOneBy (['user_id' => $userconn]);//->find($userconn);
		    
			if(!empty($groupe_id )){
				//$groupe = $childEm->getRepository(TblGroupe::class)->find($groupe_id);
				$permission = $childEm->getRepository(TblPermission::class)->findBy(['groupe_id' => $groupe_id->getGroupeId()]);
				$modules = array();
				
				foreach($permission as $key => $row){
		
					$menu_permissions[$row->getRubriqueId()->getModuleId()->getNomModule().'-'.$row->getRubriqueId()->getModuleId()->getClasse().'-'.$row->getRubriqueId()->getModuleId()->getHref()][] = $row->getRubriqueId();

				}
				
			}
		 
		}else {
			/*********************** Admin  *******************************************************/
			$bd = $this->em->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $user->getId()]);
		    $dbName = $bd->getBdName();
			$dbUser = $bd->getLogin();
			$dbPassword = $bd->getPassword();
			$dbHost = $bd->getServeur();
			$connector = $this->container->get('application_connector');
			$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
			$childEm = $this->container->get('doctrine')->getManager('child');
			$modules = $childEm->getRepository(TblModule::class)->findAll();
			foreach($modules as $key_module){
				$module = $childEm->getRepository(TblModule::class)->find($key_module);
				$rubrique = $childEm->getRepository(TblRubrique::class)->findBy(['module_id' => $module]);
				foreach($rubrique as $key => $rub){
					$menu_permissions[$module->getNomModule().'-'.$module->getClasse().'-'.$module->getHref()][] = $rub;
			    }
			}
		}
		
		return $menu_permissions;

  }
  
  public function getPermission($current_route){
	  
		$user = $this->tokenStorage->getToken()->getUser();
		$type = $user->getIdClient();
		
		if($type){
			$userid =  $user->getIdUser();
			if($userid){
				$bd = $this->em->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $type]);
				$dbName = $bd->getBdName();
				$dbUser = $bd->getLogin();
				$dbPassword = $bd->getPassword();
				$dbHost = $bd->getServeur();
				$connector = $this->container->get('application_connector');
				$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
				$childEm = $this->container->get('doctrine')->getManager('child');
				$groupe =  $childEm->getRepository(TblGroupeUser::class)->findOneBy(['user_id' => $userid]);
				$rebrique =  $childEm->getRepository(TblRubrique::class)->findOneBy(['href' => $current_route]);
				$permission = $childEm->getRepository(TblPermission::class)->findOneBy([
										'groupe_id' => $groupe->getGroupeId(),
										'rubrique_id' => $rebrique,
				]);
							
			}
		 
		}    
		else {
			  $permission = new Permission ;
		}
		
		return $permission;	 
  }
}