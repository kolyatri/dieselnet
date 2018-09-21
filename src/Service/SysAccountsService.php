<?php
namespace App\Service;

use App\Entity\SysAccounts;
use App\Entity\Countries;
use App\Entity\AccountTypes;
use App\Repository\SysAccountsRepository;
use App\Repository\CountriesRepository;
use App\Repository\AccountTypesRepository;
use Doctrine\ORM\EntityNotFoundException;
use App\Service\MyValidator;
//use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    * @var Validator
    */
    private $myValidator;
     

    /**
     * SysAccountsService constructor.
     * @param SysAccountsRepository $sysAccountsRepository
     * @param CountriesRepository $countriesRepository
     * @param AccountTypesRepository $accountTypesRepository
     * @param MyValidator $myValidator
     */
    public function __construct(
        SysAccountsRepository $sysAccountsRepository,
        CountriesRepository $countriesRepository,
        AccountTypesRepository $accountTypesRepository,
        MyValidator $myValidator
    ){    
        $this->sysAccountsRepository = $sysAccountsRepository;      
        $this->countriesRepository = $countriesRepository;
        $this->accountTypesRepository = $accountTypesRepository;
        $this->myValidator = $myValidator;
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
        //TODO: add fields to $sysAccount asserts (email, company name etc.)
       
        //validate sysAccount fields common for update or for complete registration
        $this->myValidator->validate($sysAccount, null, array('updateOrRegistrate'));        
        
        //validate password if neccassary (when status == 1 and passwordOriginal is not null) 
        //OR when status == 0 (it is complete registration)
        $accountStatus = $sysAccount->getAccountStatus();
        $accountPasswordOriginal = $sysAccount->getAccountPasswordOriginal();

        //means full registraion
        if($accountStatus == "0" || ($accountStatus == "1" && $accountPasswordOriginal !== "")){            
            $this->myValidator->validate($sysAccount, null, array('passwordOriginal'));

            $password = md5($accountPasswordOriginal);
            $sysAccount->setAccountPassword($password);
        }
        
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

    /**
    * @return SysAccounts|null
    * @param SysAccounts $sysAccount
    */
    public function addDemoSysAccount(SysAccounts $sysAccount): SysAccounts
    {  
        $this->myValidator->validate($sysAccount, null, array('startDemoRegistration'));

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new BadRequestHttpException($errorsString);
        }

        $sysAccount->setAccountUniqueCode($this->getUniqueCode());
        $sysAccount->setAccountVerifyCode($this->generateVerifyCode());

        $where = array('countryId' => 103);
        $country = $this->countriesRepository->findOneBy($where);
        $sysAccount->setAccountCountry($country);

        $where = array('accountTypeId' => 1);
        $accountType = $this->accountTypesRepository->findOneBy($where);
        $sysAccount->setAccountAccountType($accountType);        

        $this->sysAccountsRepository->save($sysAccount);
        return $sysAccount;
    }

    /**
    * @return SysAccounts|null
    * @param array $bodyData
    */
    public function verifyDemoSysAccount(array $bodyData): SysAccounts
    {  
        if(!$bodyData['accountTelephone'] || !$bodyData['accountVerifyCode']){
            throw new BadRequestHttpException("No params 'accountTelephone' or 'accountVerifyCode'");
        } 
        
        $where = array(
            'accountTelephone' => $bodyData['accountTelephone'],
            'accountVerifyCode' => $bodyData['accountVerifyCode'],
         );
        $sysAccount = $this->sysAccountsRepository->findOneBy($where);

        if($sysAccount){
            $apiToken = $this->generateRandomString(26);
            $sysAccount->setAccountApiToken($apiToken);

            $this->sysAccountsRepository->save($sysAccount);
        }else{
            throw new BadRequestHttpException("Params 'accountTelephone' or 'accountVerifyCode' are wrong");
        }

        return $sysAccount;
    }


    private function getUniqueCode($time = 0)
    {
        if ($time > 10)
        {
            throw new BadRequestHttpException("Wasn't able to generate unique code");
        }

        $uniqueCode = $this->generateRandomString(5);       

        
        $where = array('accountUniqueCode' => $uniqueCode);
        if ($this->sysAccountsRepository->findOneBy($where))
        {
            return $this->getUniqueCode($time + 1);
        } else {
            return $uniqueCode;
        }
    }

    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function generateVerifyCode($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}