<?php
namespace AppBundle\EventSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;  
use Symfony\Component\Security\Core\AuthenticationEvents;  
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;  
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;  
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;  
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;  
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManager; 
use AppBundle\Entity\TblAdmin;
use ErposBundle\Entity\TblUser;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\TblBd;
use ErposBundle\Entity\TblModule;
class SecuritySubscriber implements EventSubscriberInterface  
{

    private $entityManager;
    private $authenticationUtils;
    private $thisData;
	private $router;
	private $container;
	private $session;
    public function __construct(EntityManager $entityManager, TokenStorageInterface $tokenStorage, AuthenticationUtils $authenticationUtils,$router,ContainerInterface $container,Session $session )
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->authenticationUtils = $authenticationUtils;
		$this->router = $router;
        $this->container = $container;
		$this->session = $session;
    }

    public static function getSubscribedEvents()
    {
		
        return array(
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
			
    }

    public function onAuthenticationFailure( AuthenticationFailureEvent $event )
    {
	
		$username = $this->authenticationUtils->getLastUsername();
		// var_dump($this->authenticationUtils);die();
		$existingUser = $this->entityManager->getRepository(TblAdmin::class)->findOneBy(['username' => $username]);
		if ($existingUser) {
		error_log("Log In Denied: Wrong password for User #" . $existingUser->getId()  . " (" . $existingUser->getEmail() . ")");
		} else {
		error_log("Log In Denied: User doesn't exist: " . $username);
		}
    }

    public function onSecurityInteractiveLogin( InteractiveLoginEvent $event )
    {
        $user = $this->tokenStorage->getToken()->getUser();
		 
		/*if(in_array('ROLE_USER',$user->getRoles())){
			$url = $this->router->generate('system', array(
					'user' => $user 
			));
		}*/
		if(in_array('ROLE_ADMIN',$user->getRoles())){
			$url = $this->router->generate('admin');
		}else {
			$type = $user->getIdClient();
			if($type){
				$bd = $this->entityManager->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $type]);
				$dbName = $bd->getBdName();
				$dbUser = $bd->getLogin();
				$dbPassword = $bd->getPassword();
				$dbHost = $bd->getServeur();
				$connector = $this->container->get('application_connector');
				$connector->resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = true);
				$childEm = $this->container->get('doctrine')->getManager('child');
				$userconn = $childEm->getRepository(TblUser::class)->find($user->getIdUser());
				$userconn->setDernierAct(new \DateTime());
				$childEm->flush();
				$user->setDernierAct(new \DateTime());
				$this->entityManager->flush();
				$this->session->set('dbName', $dbName);
				$this->session->set('dbUser', $dbUser);
				$this->session->set('dbPassword', $dbPassword );
				$this->session->set('dbHost', $dbHost);
				
			}else {
				$bd = $this->entityManager->getRepository(TblBd::class)->findOneBy(['tblAdmin' => $user->getId()]);
				$dbName = $bd->getBdName();
				$dbUser = $bd->getLogin();
				$user->setDernierAct(new \DateTime());
				$this->entityManager->flush();
				$dbPassword = $bd->getPassword();
				$dbHost = $bd->getServeur();
				$this->session->set('dbName', $dbName);
				$this->session->set('dbUser', $dbUser);
				$this->session->set('dbPassword', $dbPassword );
				$this->session->set('dbHost', $dbHost);

				
			}
			$url = $this->router->generate('system');
			
			
 
		}
 
		 $response = new RedirectResponse($url);
		 
	 
		 $response->send();
		
		
		// print_r($user->getRoles());
		// die();
		// echo $url; die();
        // echo("Log In: User #" . $user->getId()  . " (" . $user->getEmail() . ")");
		// die();
    }
}