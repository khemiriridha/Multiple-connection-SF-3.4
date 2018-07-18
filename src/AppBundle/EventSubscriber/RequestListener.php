<?php
namespace AppBundle\EventSubscriber;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
class RequestListener{
	
	protected $templating;
	


	public function __construct(EngineInterface $templating)
	{
		$this->templating = $templating;

	}

	public function onKernelResponse(FilterResponseEvent $event){
		$response = $event->getResponse();
		$request = $event->getRequest();

		 
		$_route  = $request->attributes->get('_route');
		if($_route != 'search'){
			
		$content = $response->getContent();
		// $content = str_replace(
		  // 'pageLoadingFrame("show")',
		  // 'setTimeout(function(){
						 // pageLoadingFrame("hide");
                    // },6000); ',
			// $content 
		// );
		$response->setContent($content);
		}
		return $response;
		
	 
	}
}