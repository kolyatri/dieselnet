<?php
namespace App\Controller\Rest;
use App\Service\PhotosService;
use App\Service\SysAccountsService;
use App\Entity\Photos;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;


/**
 * Class PhotosController
 * @package App\Controller
 */
final class PhotosController extends FOSRestController
{
     /**
     * @var PhotosService
     */
    private $photosService;

    /**
     * @var SysAccountsService
     */
    private $sysAccountsService;

    /**
     * @var SysAccounts
     */
    private $sysAccount;

     /**
     * @var Request
     */
    private $request;

     /**
     * PhotosController constructor.
     * @param PhotosService $photosService
     * @param SysAccountsService $sysAccountsService  
     * @param RequestStack $requestStack  
     */
    public function __construct(
        PhotosService $photosService,
        SysAccountsService $sysAccountsService,
        RequestStack $requestStack        
    )
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->photosService = $photosService;
        $this->sysAccountsService = $sysAccountsService;

        $apiToken = $this->request->headers->get('Api-token');
        //if we are here, means we passed rqeust listener and if no api-token 
        //the route contains startTelephoneRegistration OR finishTelephoneRegistration
        if($apiToken){
            $where = array('accountApiToken' => $apiToken);
            $this->sysAccount = $this->sysAccountsService->getOneSysAccount($where);
        }    
    }

    /**    
     * @Route("/markPhotoAsPrimary/{adsId}/{photoId}",
     * requirements={"adsId" = "\d+","photoId" = "\d+"},
     * methods={"PUT"})     
     *
     * @return Response
     */
    public function markPhotoAsPrimary($adsId, $photoId): Response
    {              
        $this->photosService->markPhotoAsPrimary($this->sysAccount, $adsId, $photoId);        
        
        return new Response();
    }
    
}