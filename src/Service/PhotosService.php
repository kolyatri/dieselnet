<?php
namespace App\Service;
use App\Entity\Photos;
use App\Repository\PhotosRepository;

use App\Service\MyValidator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class PhotosService
 * @package App\Service
 */
final class PhotosService
{
    /**
    * @var PhotosRepository
    */
    private $photosRepository;     

    /**
     * PhotosService constructor.
     * @param PhotosRepository $photosRepository     
     */
    public function __construct(
        PhotosRepository $photosRepository        
    ){    
        $this->photosRepository = $photosRepository;    
    }   

    /**
    * @return void
    * @param SysAcccounts $sysAccounts
    * @param int $adsId
    * @param int $photoId
    */
    public function markPhotoAsPrimary($sysAccounts, $adsId, $photoId): void
    {
        $where = array(
            'photoId' => $photoId,
            'photoAds' => $adsId,
            'photoAccount' => $sysAccounts->getAccountId()
        );
        $newPrimaryPhoto = $this->photosRepository->findOneBy($where);

        if(!$newPrimaryPhoto){
            throw new BadRequestHttpException("No such photo or it doesn't belong to you!");
        }

        $this->photosRepository->unprimaryAdsPhotos($adsId);
        $newPrimaryPhoto->setPhotoPrimary('1');
        $this->photosRepository->save($newPrimaryPhoto);
    } 
}