<?php
namespace App\Repository;
use App\Entity\PhotosSizes;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class PhotosSizesRepository
 * @package App\Repository
 */
final class PhotosSizesRepository 
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
     * PhotosSizesRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(PhotosSizes::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return PhotosSizes|null
     * @param array $where
     */
    public function findOneBy($where): ?PhotosSizes
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
}