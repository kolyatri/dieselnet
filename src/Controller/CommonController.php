<?php
namespace App\Controller;
use App\Service\CommonService;
//use App\Entity\SysAccounts;
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




/**
 * Class CommonController
 * @package App\Controller
 */
final class CommonController extends FOSRestController
{
     /**
     * @var CommonService
     */
    private $commonService;

    /**
     * @var Serializer
     */
    private $serializer;


     /**
     * CommonController constructor.
     * @param CommonService $commonService
     */
    public function __construct(CommonService $commonService)
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(
            array(
                "__initializer__",
                "__cloner__",
                "__isInitialized__",
                "maincatCatalog",
                "categoryMaincat",
                "modelBrand"
            )
        );
        /*$normalizer->setCircularReferenceLimit(1000);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getCatalogId();
        });*/
        $this->serializer = new Serializer(array($normalizer), array($encoder));

        $this->commonService = $commonService;
    }

    /**
     * Retrieves app initial info
     * @Rest\Get("/initialInfo")
     * @return Response
     */
    public function getInitialInfo(): Response
    {
        $initialInfo = $this->commonService->getInitialInfo();        
        $jsonContent = $this->serializer->serialize($initialInfo, 'json');                
        
        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of article object
        return new Response($jsonContent);        
    }

}