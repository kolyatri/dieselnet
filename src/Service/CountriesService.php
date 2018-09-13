<?php
namespace App\Service;
use App\Entity\Countries;
use App\Repository\CountriesRepository;
use App\Repository\AccountTypesRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CountriesService
 * @package App\Service
 */
final class CountriesService
{
     /**
     * @var CountriesRepository
     */
    private $countriesRepository;
     /**
     * @var AccountTypesRepository
     */
    private $accountTypesRepository;

    /**
     * CountriesService constructor.
     * @param CountriesRepository $countriesRepository
     * @param AccountTypesRepository $accountTypesRepository
     */
    public function __construct(
        CountriesRepository $countriesRepository,
        AccountTypesRepository $accountTypesRepository
    ){
    //public function __construct(){
        //$this->countriesRepository = new CountriesRepository();
        $this->countriesRepository = $countriesRepository;
        $this->accountTypesRepository = $accountTypesRepository;
    }

     /**
     * @return array|null
     */
    public function getAllCountries(): ?array
    {
        return $this->countriesRepository->findAll();
        //return array("Russia","England");
    }

    /**
     * @return array|null
     */
    public function getAllCountriesAndAccountTypes(): ?array
    {        
        return array_merge($this->countriesRepository->findAll(), $this->accountTypesRepository->findAll());
        //return array("Russia","England");
    }

}
