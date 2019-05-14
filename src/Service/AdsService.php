<?php
namespace App\Service;

use App\Entity\Ads;
use App\Entity\SysAccounts;
use App\Entity\Favourites;
use App\Repository\AdsRepository;
use App\Repository\VisitsRepository;
use App\Repository\FavouritesRepository;
use App\Repository\PhotosRepository;
use App\Repository\PhotosSizesRepository;
use App\Repository\CatalogsRepository;
use App\Repository\MaincatsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\BrandsRepository;
use App\Repository\ModelsRepository;
use Doctrine\ORM\EntityNotFoundException;

use App\Service\MyValidator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class AdsService
 * @package App\Service
 */
final class AdsService
{
    /**
    * @var AdsRepository
    */
    private $adsRepository;

    /**
    * @var VisitsRepository
    */
    private $visitsRepository;

    /**
    * @var FavouritesRepository
    */
    private $favouritesRepository;

    /**
    * @var PhotosRepository
    */
    private $photosRepository;
    /**
    * @var PhotosSizesRepository
    */
    private $photosSizesRepository;

    /**
     * @var CatalogsRepository
     */
    private $catalogsRepository;  
    /**
     * @var MaincatsRepository
     */
    private $maincatsRepository;     
    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;     
    /**
     * @var BrandsRepository
     */
    private $brandsRepository;   
    /**
     * @var ModelsRepository
     */
    private $modelsRepository; 
     

    /**
     * AdsService constructor.
     * @param AdsRepository $adsRepository    
     * @param CatalogsRepository $catalogsRepository
     * @param MaincatsRepository $maincatsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param BrandsRepository $brandsRepository
     * @param ModelsRepository $modelsRepository 
     */
    public function __construct(
        AdsRepository $adsRepository,
        VisitsRepository $visitsRepository,
        FavouritesRepository $favouritesRepository,
        PhotosRepository $photosRepository,
        PhotosSizesRepository $photosSizesRepository,
        CatalogsRepository $catalogsRepository,
        MaincatsRepository $maincatsRepository,
        CategoriesRepository $categoriesRepository,
        BrandsRepository $brandsRepository,
        ModelsRepository $modelsRepository
        //MyValidator $myValidator
    ){    
        $this->adsRepository = $adsRepository;
        $this->visitsRepository = $visitsRepository;
        $this->favouritesRepository = $favouritesRepository;      
        $this->photosRepository = $photosRepository;
        $this->photosSizesRepository = $photosSizesRepository;
        $this->catalogsRepository = $catalogsRepository;      
        $this->maincatsRepository = $maincatsRepository;     
        $this->categoriesRepository = $categoriesRepository;    
        $this->brandsRepository = $brandsRepository;
        $this->modelsRepository = $modelsRepository;
        //$this->myValidator = $myValidator;
    }

     /**
     * @return array|null
     */
    /*public function getAllSysAccounts(): ?array
    {
        return $this->sysAccountsRepository->findAll();
        //return array("Russia","England");
    }*/

    /**
    * @return Ads|null
    * @param int $adsId
    * @param bool $isOwner
    * @param SysAcccounts $sysAccounts
    */
    public function getOneAds($adsId, $isOwner, $sysAccounts): ?Ads
    {
        $isOwner = ($isOwner === 'true');
        $where = array('adsId' => $adsId);        
        
        if($isOwner){            
            $where['adsAccount'] = $sysAccounts->getAccountId();
        }
        $ads = $this->adsRepository->findOneBy($where); 

        if($ads){
            if(!$isOwner){
                $where = array('visitAds' => $ads->getAdsId());
                $visits = $this->visitsRepository->findBy($where);
                $ads->setAdsVisitsCount(count($visits));

                $where = array('favouritesAds' => $ads->getAdsId());
                $favourites = $this->favouritesRepository->findBy($where);
                $ads->setAdsFavouritesCount(count($favourites));

                $where = array('favouritesAds' => $ads->getAdsId(),'favouritesAccount' => $sysAccounts->getAccountId());
                $favourite = $this->favouritesRepository->findOneBy($where);
                if($favourite)                
                    $ads->setAdsIsFavourited(true);
                else
                    $ads->setAdsIsFavourited(false);
            }

            $this->setPrimaryPhoto($ads); 

            $where = array('photoAds' => $ads->getAdsId());
            $photos = $this->photosRepository->findBy($where);           

            foreach($photos as $photo){
                $where = array('photoSizePhoto' => $photo->getPhotoId());
                $photosSizes = $this->photosSizesRepository->findBy($where);
                $photo->setPhotoPhotoSizes($photosSizes);
            }

            $ads->setAdsPhotos($photos);
        }

        return $ads;
    }

    /**
    * @return array|null
    * @param bool $isOwner
    * @param SysAcccounts $sysAccounts
    */
    public function getAds($isOwner, $sysAccounts): ?array
    {
        $isOwner = ($isOwner === 'true');   
        
        if($isOwner){
            $adsAccount = $sysAccounts->getAccountId();
            $conditions[] = " ads.adsAccount = $adsAccount ";
        }

        $conditions[] =  " ads.adsStatus <> '8' ";
        $orders = array('ads.adsCreatedOn' => 'DESC'); 
      
        $ads = $this->adsRepository->baseFindBy($conditions,$orders);      
        

        foreach($ads as $ad){
            $this->setPrimaryPhoto($ad);        
        }

        return $ads;
    }
    //TODO: combine getFavouriteAds() with getAds()
    /**
    * @return array|null
    * @param SysAcccounts $sysAccounts
    */
    public function getFavouriteAds($sysAccounts): ?array
    {     
        $where = array('favouritesAccount' => $sysAccounts->getAccountId());
        $favourites = $this->favouritesRepository->findBy($where);

        if(!$favourites){
            return null;
        }

        $conditions = array(" ads.adsId IN (");
        //$ads = array();
        for($i=0; $i<count($favourites); $i++){
            //$adsIds[] = $favourite->getFavouritesAds()->getAdsId();
            $conditions[0] .=  $favourites[$i]->getFavouritesAds()->getAdsId();
            if($i+1 < count($favourites)){
                $conditions[0] .=",";
            }
        }
        $conditions[0] .=  ")";
        $conditions[] =  " ads.adsStatus <> '8' ";

        $orders = array('ads.adsCreatedOn' => 'DESC');        

        $ads = $this->adsRepository->baseFindBy($conditions, $orders);
        
        
        foreach($ads as $ad){
            $this->setPrimaryPhoto($ad);                   
        }

        return $ads;
    }

    /**
    * @return void
    * @param SysAcccounts $sysAccounts
    * @param int $adsId
    */
    public function deleteOneAds($sysAccounts, $adsId): void
    {
        $where = array('adsAccount' => $sysAccounts->getAccountId(), 'adsId' => $adsId);
        $ad = $this->adsRepository->findOneBy($where);

        if(!$ad){
            throw new BadRequestHttpException('This ad is not yours or doesnt exist!');
        }

        $ad->setAdsStatus('8');
        $this->adsRepository->save($ad);
    } 

    /**
    * @return void
    * @param SysAcccounts $sysAccounts
    * @param int $adsId
    * @param string $toPublish
    */
    public function publishOneAds($sysAccounts, $adsId, $toPublish): void
    {

        if($sysAccounts->getAccountStatus() !== '1'){
            throw new AccessDeniedHttpException('Forbidden');
        }

        $where = array('adsAccount' => $sysAccounts->getAccountId(), 'adsId' => $adsId);
        $ad = $this->adsRepository->findOneBy($where);

        if(!$ad){
            throw new BadRequestHttpException('This ad is not yours or doesnt exist!');
        }

        $toPublish = ($toPublish === 'true');   

        if($toPublish){
            $where = array('photoAds' => $adsId);
            if(!$this->photosRepository->findBy($where)){
                throw new  NotAcceptableHttpException();
            }
        }

        if($toPublish)
            $ad->setAdsStatus('1');
        else
            $ad->setAdsStatus('0');
       
        $this->adsRepository->save($ad);
    } 
   
    /**
    * @return void
    * @param SysAcccounts $sysAccounts
    * @param int $adsId
    * @param string $toFavourite
    */
    public function favouriteOneAds($sysAccounts, $adsId, $toFavourite): void
    {
        $ad = $this->adsRepository->findOneBy(array('adsId' => $adsId));
        if(!$ad){
            throw new BadRequestHttpException('No such ad!');
        }

        $toFavourite = ($toFavourite === 'true');   

        $conditions = array(
            'favouritesAccount' => $sysAccounts->getAccountId(),
            'favouritesAds' => $ad->getAdsId()
        );
        $favourite = $this->favouritesRepository->findOneBy($conditions);     

        if($toFavourite && !$favourite){
            $newFavourite = new Favourites();
            $newFavourite->setFavouritesAccount($sysAccounts);
            $newFavourite->setFavouritesAds($ad);
            $this->favouritesRepository->save($newFavourite);
        }
        else if(!$toFavourite && $favourite){
            $this->favouritesRepository->delete($favourite);
        }
        else{
            throw new BadRequestHttpException('Logic error! Please check params!');
        }        
    } 

     /**
    * @return void
    * @param Ads $ad
    * @param SysAcccounts $sysAccounts
    * @param array $bodyData
    * @param Serializer $serializer
    */
    public function apiPrepareAds($ad, $sysAccounts, $bodyData, $serializer): void
    {        
        $this->validateBodyParams($bodyData);


        $catalog = $this->catalogsRepository->findOneBy(array('catalogId' => $bodyData['adsCatalog']));
        $maincat = $this->maincatsRepository->findOneBy(array('maincatId' => $bodyData['adsMaincat']));
        $category = $this->categoriesRepository->findOneBy(array('categoryId' => $bodyData['adsCategory']));
        
        if(!$catalog || !$maincat || !$category){
            throw new BadRequestHttpException("No such catalog or maincat or category");
        }

        $brand = $this->brandsRepository->findOneBy(array('brandValue' => $bodyData['adsBrand']));
        if(!$brand){
            throw new BadRequestHttpException("No such brand found");
        }

        if($sysAccounts->getAccountStatus() !== '1'){
            throw new AccessDeniedHttpException('Forbidden');
        }

        $where = array('adsAccount' => $sysAccounts->getAccountId(), 'adsId' => $adsId);
        $ad = $this->adsRepository->findOneBy($where);

        if(!$ad){
            throw new BadRequestHttpException('This ad is not yours or doesnt exist!');
        }

        $toPublish = ($toPublish === 'true');   

        if($toPublish){
            $where = array('photoAds' => $adsId);
            if(!$this->photosRepository->findBy($where)){
                throw new  NotAcceptableHttpException();
            }
        }

        if($toPublish)
            $ad->setAdsStatus('1');
        else
            $ad->setAdsStatus('0');
       
        $this->adsRepository->save($ad);
    } 

    private function setPrimaryPhoto(&$ad){
        $where = array('photoAds' => $ad->getAdsId(),'photoPrimary' => '1');
        $primaryPhoto = $this->photosRepository->findOneBy($where);
        $ad->setAdsPrimaryPhoto($primaryPhoto);       
    }

    private function validateBodyParams($bodyData){
        if(!$bodyData){
            throw new BadRequestHttpException("No body param found.");
        }

        if(!array_key_exists('adsCatalog', $bodyData) 
        || !array_key_exists('adsMaincat', $bodyData)
        || !array_key_exists('adsCategory', $bodyData)
        || !array_key_exists('adsBrand', $bodyData)
        || !array_key_exists('adsModel', $bodyData)
        //|| !array_key_exists('adsCountry', $bodyData)
        //|| !array_key_exists('adsYear', $bodyData)
        ){
            throw new BadRequestHttpException("Not all required params");
        }
    }
}