<?php
namespace App\Controller\Rest;
use App\Service\SysAccountsService;
use App\Entity\SysAccounts;
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




/**
 * Class SysAccountsController
 * @package App\Controller
 */
final class SysAccountsController extends FOSRestController
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
     * @var string
     */
    //private $apiToken;

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
    public function __construct(SysAccountsService $sysAccountsService, RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array("__initializer__","__cloner__","__isInitialized__"));
        $this->serializer = new Serializer(array($normalizer), array($encoder));

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
     * Retrieves a collection of SysAccount resource
     * @Rest\Get("/sysAccount")
     * @return Response
     */
    //public function getOneSysAccount(Request $request): Response
    public function getOneSysAccount(): Response
    {       
        $jsonContent = $this->serializer->serialize($this->sysAccount, 'json');   
        
        return new Response($jsonContent);
    }

    /**
     * Replaces SysAccount resource
     * @Rest\Put("/sysAccount")
     * @return Response
     */
    public function putSysAccount(): Response
    {
        $bodyJsonData = $this->request->getContent();
        $bodyData =  json_decode($bodyJsonData, true);             

        if(!array_key_exists('accountCountry', $bodyData) || !array_key_exists('accountAccountType', $bodyData)){
            throw new BadRequestHttpException("No params 'accountCountry' or 'accountAccountType'");
        }
        $countryId = $bodyData['accountCountry'];
        $accountTypeId = $bodyData['accountAccountType'];

        unset($bodyData['accountCountry']);
        unset($bodyData['accountAccountType']);
        unset($bodyData['accountTelephone']);

        $bodyJsonData = json_encode($bodyData);
        $this->serializer->deserialize($bodyJsonData, SysAccounts::class, 'json', array('object_to_populate' => $this->sysAccount));
        
        $this->sysAccount = $this->sysAccountsService->updateSysAccount(
            $this->sysAccount,
            $countryId,
            $accountTypeId
        );

        $jsonContent = $this->serializer->serialize(array('account' => $this->sysAccount),'json');

        return new Response($jsonContent);        
    }

    /**
     * Create SysAccount resource
     * @Rest\Post("/startTelephoneRegistration")
     * @return Response
     */
    public function startTelephoneRegistration(): Response
    {
        $this->sysAccount = new SysAccounts();
        $bodyJsonData = $this->request->getContent();  
        $this->serializer->deserialize($bodyJsonData, SysAccounts::class, 'json', array('object_to_populate' => $this->sysAccount));
        
        $this->sysAccount = $this->sysAccountsService->addDemoSysAccount($this->sysAccount);

        $jsonContent = $this->serializer->serialize(array('account' => $this->sysAccount),'json');
        return new Response($jsonContent);
    }

    /**
     * Create SysAccount resource
     * @Rest\Post("/finishTelephoneRegistration")
     * @return Response
     */
    public function finishTelephoneRegistration(): Response
    {
        $bodyJsonData = $this->request->getContent();  
        $bodyData = json_decode($bodyJsonData, true);
        
        $this->sysAccount = $this->sysAccountsService->verifyDemoSysAccount($bodyData);

        $jsonContent = $this->serializer->serialize(array('account' => $this->sysAccount),'json');
        return new Response($jsonContent);
    }
}