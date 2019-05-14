<?php
namespace App\Controller\Rest;
use App\Service\SysAccountsService;
use App\Service\AdsService;
use App\Entity\Ads;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;




/**
 * Class AdsController
 * @package App\Controller
 */
final class AdsController extends FOSRestController
{
     /**
     * @var SysAccountsService
     */
    private $sysAccountsService;

    /**
     * @var Serializer
     */
    private $serializer;    

    /**
     * @var SysAccounts
     */
    private $adsService;

    /**
     * @var SysAccounts
     */
    private $sysAccount;

    /**
     * @var Request
     */
    private $request;


     /**
     * SysAccountsController constructor.
     * @param SysAccountsService $sysAccountsService     
     * @param RequestStack $requestStack
     */
    public function __construct(
        SysAccountsService $sysAccountsService,
        AdsService $adsService,
        RequestStack $requestStack
    )
    {        
        $this->request = $requestStack->getCurrentRequest();
        $this->sysAccountsService = $sysAccountsService;
        $this->adsService =  $adsService;

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array(
            "__initializer__",
            "__cloner__",
            "__isInitialized__",
            "photoAds",
            "photoSizePhoto"
        ));
        $this->serializer = new Serializer(array($normalizer), array($encoder));      

        $apiToken = $this->request->headers->get('Api-token');
        //if we are here, means we passed rqeust listener and if no api-token 
        //the route contains startTelephoneRegistration OR finishTelephoneRegistration
        if($apiToken){
            $where = array('accountApiToken' => $apiToken);
            $this->sysAccount = $this->sysAccountsService->getOneSysAccount($where);
        }        
    }

    /**    
     * @Route("/ad/{adsId}/{isOwner}",
     * requirements={"adsId" = "\d+", "isOwner" = "true|false"},
     * methods={"GET"})     
     *
     * @return Response
     */
    public function getOneAds($adsId,$isOwner): Response
    {              
        $ads = $this->adsService->getOneAds($adsId,$isOwner,$this->sysAccount);        
        
        $jsonContent = $this->serializer->serialize(array('ads' => $ads),'json');

        return new Response($jsonContent);   
    }

    /**    
     * @Route("/ads/{isOwner}",
     * requirements={"isOwner" = "true|false"},
     * methods={"GET"})     
     *
     * @return Response
     */
    public function getAds($isOwner): Response
    {              
        $ads = $this->adsService->getAds($isOwner, $this->sysAccount);        
        
        $jsonContent = $this->serializer->serialize(array('ads' => $ads),'json');

        return new Response($jsonContent);   
    }

    /**    
     * @Route("/favouriteAds",
     * methods={"GET"})     
     *
     * @return Response
     */
    public function getFavouriteAds(): Response
    {              
        $ads = $this->adsService->getFavouriteAds($this->sysAccount);        
        
        $jsonContent = $this->serializer->serialize(array('ads' => $ads),'json');

        return new Response($jsonContent);   
    }

     /**
     * Add Ads resource
     * @Route("/ad",methods={"POST"})    
     * 
     * @return Response
     */
    public function addOneAds(): Response
    {
        $ad = new Ads();
        $bodyJsonData = $this->request->getContent();
        $bodyData =  json_decode($bodyJsonData, true);       

        $jsonContent = $this->adsService->apiPrepareAds($ad, $this->sysAccount, $bodyData, $this->serializer);
        return new Response($jsonContent);        
    }



    /**    
     * @Route("/ad/{adsId}",
     * requirements={"adsId" = "\d+"},
     * methods={"DELETE"})     
     *
     * @return Response
     */
    public function deleteOneAds($adsId): Response
    {              
        $ads = $this->adsService->deleteOneAds($this->sysAccount,$adsId);        
        
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        return $response; 
    }


    /**    
     * @Route("/publishAd/{adsId}/{toPublish}",
     * requirements={"adsId" = "\d+","toPublish" = "true|false"},
     * methods={"PUT"})     
     *
     * @return Response
     */
    public function publishOneAds($adsId,$toPublish): Response
    {              
        $this->adsService->publishOneAds($this->sysAccount,$adsId,$toPublish);        
        
        return new Response();
    }

    /**    
     * @Route("/favouriteAd/{adsId}/{toFavourite}",
     * requirements={"adsId" = "\d+","toFavourite" = "true|false"},
     * methods={"PUT"})     
     *
     * @return Response
     */
    public function favouriteOneAds($adsId,$toFavourite): Response
    {              
        $this->adsService->favouriteOneAds($this->sysAccount,$adsId,$toFavourite);        
        
        return new Response();
    }
}