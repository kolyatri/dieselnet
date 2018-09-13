<?php
namespace App\Controller;
use App\Service\CountriesService;
use App\Entity\Countries;
//use App\Domain\Model\Article\ArticleRepositoryInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class CountriesController
 * @package App\Controller
 */
final class CountriesController extends FOSRestController
{
     /**
     * @var CountriesService
     */
    private $countriesService;

     /**
     * CountriesController constructor.
     * @param CountriesService $countriesService
     */
    public function __construct(CountriesService $countriesService)
    {
        $this->countriesService = $countriesService;
    }

    /**
     * Retrieves a collection of Country resource
     * @Rest\Get("/countries")
     * @return View
     */
    public function getCountries(): View
    {
        $countries = $this->countriesService->getAllCountries();
        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of article object
        return View::create($countries, Response::HTTP_OK);
    }

     /**
     * Retrieves a collection of Country resource
     * @Rest\Get("/countriesandaccounttypes")
     * @return View
     */
    public function getCountriesAndAccountTypes(): View
    {
        $result = $this->countriesService->getAllCountriesAndAccountTypes();
        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of article object
        return View::create($result, Response::HTTP_OK);
    }
}