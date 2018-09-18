<?php
namespace App\Service;
use App\Entity\SysAccounts;
use App\Entity\Countries;
use App\Entity\AccountTypes;
use App\Repository\SysAccountsRepository;
use App\Repository\CountriesRepository;
use App\Repository\AccountTypesRepository;
use Doctrine\ORM\EntityNotFoundException;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class SysAccountsService
 * @package App\Service
 */
final class SysAccountsService
{
    /**
    * @var SysAccountsRepository
    */
    private $sysAccountsRepository;

    /**
    * @var CountriesRepository
    */
    private $countriesRepository;

    /**
    * @var AccountTypesRepository
    */
    private $accountTypesRepository;
     

    /**
     * SysAccountsService constructor.
     * @param SysAccountsRepository $sysAccountsRepository
     * @param CountriesRepository $countriesRepository
     * @param AccountTypesRepository $accountTypesRepository
     */
    public function __construct(
        SysAccountsRepository $sysAccountsRepository,
        CountriesRepository $countriesRepository,
        AccountTypesRepository $accountTypesRepository   
    ){
    //public function __construct(){
        //$this->countriesRepository = new CountriesRepository();
        $this->sysAccountsRepository = $sysAccountsRepository;      
        $this->countriesRepository = $countriesRepository;
        $this->accountTypesRepository = $accountTypesRepository;
    }

     /**
     * @return array|null
     */
    public function getAllSysAccounts(): ?array
    {
        return $this->sysAccountsRepository->findAll();
        //return array("Russia","England");
    }

    /**
    * @return SysAccounts|null
    * @param array $where
    */
    public function getOneSysAccount($where): ?SysAccounts
    {
        return $this->sysAccountsRepository->findOneBy($where);        
    }

    /**
    * @return SysAccounts|null
    * @param SysAccounts $sysAccount
    * @param int $countryId
    * @param int $accountTypeId
    */
    public function updateSysAccount(SysAccounts $sysAccount, $countryId, $accountTypeId): ?SysAccounts
    {
        $where = array('countryId' => $countryId);
        $country = $this->countriesRepository->findOneBy($where);

        $where = array('accountTypeId' => $accountTypeId);
        $accountType = $this->accountTypesRepository->findOneBy($where);

        if(!$country || !$accountType){
            throw new BadRequestHttpException("Country or account type weren't found!");
        }

        $sysAccount->setAccountCountry($country);
        $sysAccount->setAccountAccountType($accountType);
        $this->sysAccountsRepository->save($sysAccount);

        return $sysAccount;        
    }

}
