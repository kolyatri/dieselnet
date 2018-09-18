<?php
namespace App\Controller;
use App\Service\SysAccountsService;
use App\Entity\SysAccounts;
//use App\Domain\Model\Article\ArticleRepositoryInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
//use FOS\RestBundle\View\View;
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
        $where = array('accountApiToken' => $apiToken);
        $this->sysAccount = $this->sysAccountsService->getOneSysAccount($where);        
    }

    /**
     * Retrieves a collection of SysAccount resource
     * @Rest\Get("/sysAccount")
     * @return Response
     */
    //public function getOneSysAccount(Request $request): Response
    public function getOneSysAccount(): Response
    {
        //$apiToken = $request->headers->get('Api-token');
        //$where = array('accountApiToken' => $apiToken);
        //$sysAccount = $this->sysAccountsService->getOneSysAccount($where);        
        //$jsonContent = $this->serializer->serialize($sysAccount, 'json');   
        //$jsonContent = $this->serializer->serialize($sysAccount, 'json');   
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
        //var_dump($bodyData);die;

        if(!array_key_exists('accountCountry', $bodyData) || !array_key_exists('accountAccountType', $bodyData)){
            throw new BadRequestHttpException("No params 'accountCountry' or 'accountAccountType'");
        }
        $countryId = $bodyData['accountCountry'];
        $accountTypeId = $bodyData['accountAccountType'];

        unset($bodyData['accountCountry']);
        unset($bodyData['accountAccountType']);

        $bodyJsonData = json_encode($bodyData);
        $this->serializer->deserialize($bodyJsonData, SysAccounts::class, 'json', array('object_to_populate' => $this->sysAccount));
        
        $this->sysAccount = $this->sysAccountsService->updateSysAccount(
            $this->sysAccount,
            $countryId,
            $accountTypeId
        );

        $jsonContent = $this->serializer->serialize(array('account' => $this->sysAccount),'json');

        return new Response($jsonContent);

        /*$sysAccount = $this->articleRepository->findById($articleId);
        if ($article) {
            $article->setTitle($request->get('title'));
            $article->setContent($request->get('content'));
            $this->articleRepository->save($article);
        }*/
        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        //return View::create($article, Response::HTTP_OK);
        //return View::create($article, Response::HTTP_OK);
    }



}