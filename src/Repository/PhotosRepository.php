<?php
namespace App\Repository;
use App\Entity\Photos;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class PhotosRepository
 * @package App\Repository
 */
final class PhotosRepository 
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ObjectRepository
     */
    private $objectRepository;
    /**
     * PhotosRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Photos::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return Photos|null
     * @param array $where
     */
    public function findOneBy($where): ?Photos
    {
        return $this->objectRepository->findOneBy($where);              
    }

    /**
     * @return array|null
     * @param array $where
     */
    public function findBy($where): ?array
    {
        return $this->objectRepository->findBy($where);              
    }

    /**
     * @param int $adsId
     */
    public function unprimaryAdsPhotos($adsId) 
    {        
        $qb = $this->entityManager->createQueryBuilder();
        $qb = $qb->update('App\Entity\Photos', 'p')
                ->set('p.photoPrimary','0')
                ->where('p.photoAds = ?1')                
                ->setParameter(1, $adsId)
                ->getQuery();
        $p = $qb->execute();        
    }



    /**
    * @param Photos $photo
    */
    public function save(Photos $photo): void
    {
        $this->entityManager->persist($photo);
        $this->entityManager->flush();
    }
}