<?php
namespace App\EventListener;
use App\Entity\SysAccounts;
use App\Service\SysAccountsService;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RequestListener
{

     /**
     * @var SysAccountsService
     */
    private $sysAccountsService;

     /**
     * RequestListener constructor.
     * @param SysAccountsService $sysAccountsService
     */
    public function __construct(SysAccountsService $sysAccountsService)
    {
        $this->sysAccountsService = $sysAccountsService;
    }

    public function validateSecretAndApiToken(GetResponseEvent $event)
    {       
        $request = $event->getRequest();
        $uri = $request ->getRequestUri();

        if (strpos($uri, '/api/') !== false) {
           
            $secret = $request->headers->get('Secret');
            $appSecret = getenv('APP_SECRET');
            
            if($secret != $appSecret){
                throw new AccessDeniedHttpException('Forbidden');
            }

            $apiToken = $request->headers->get('Api-token');      
            

            $pos1 = strpos($uri, 'startTelephoneRegistration');
            $pos2 = strpos($uri, 'finishTelephoneRegistration');

            //the case when need check API TOKEN
            if ($pos1 === false && $pos2 === false) {            
                $this->validateApiToken($apiToken);
            } 
        }
    }

    //validate token in DB
    private function validateApiToken($apiToken)
    {
        if(!$apiToken){
            throw new AccessDeniedHttpException('Forbidden');
        }
       
        $where = array('accountApiToken' => $apiToken);
        $sysAccount = $this->sysAccountsService->getOneSysAccount($where);        
          
        if(!$sysAccount){       
            throw new AccessDeniedHttpException('Forbidden');
        }
    }
}