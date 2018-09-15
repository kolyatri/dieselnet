<?php
namespace App\Service;
use App\Entity\SysAccounts;
use App\Repository\SysAccountsRepository;
use Doctrine\ORM\EntityNotFoundException;

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
     * SysAccountsService constructor.
     * @param SysAccountsRepository $sysAccountsRepository
     */
    public function __construct(
        SysAccountsRepository $sysAccountsRepository       
    ){
    //public function __construct(){
        //$this->countriesRepository = new CountriesRepository();
        $this->sysAccountsRepository = $sysAccountsRepository;      
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

}
