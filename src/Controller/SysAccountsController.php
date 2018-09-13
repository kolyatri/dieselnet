<?php
namespace App\Controller;
use App\Service\SysAccountsService;
use App\Entity\SysAccounts;
//use App\Domain\Model\Article\ArticleRepositoryInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;



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
     * SysAccountsController constructor.
     * @param SysAccountsService $sysAccountsService
     */
    public function __construct(SysAccountsService $sysAccountsService)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $this->serializer = new Serializer($normalizers, $encoders);

        $this->sysAccountsService = $sysAccountsService;
    }

    /**
     * Retrieves a collection of SysAccount resource
     * @Rest\Get("/sysaccounts")
     * @return View
     */
    public function getSysAccounts(): View
    {
        $sysAccounts = $this->sysAccountsService->getAllSysAccounts();
        
        //$jsonContent = $this->serializer->serialize($sysAccounts, 'json');
        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of article object
        return View::create($sysAccounts, Response::HTTP_OK);
        //return new JsonResponse($jsonContent,Response::HTTP_OK);
    }

}