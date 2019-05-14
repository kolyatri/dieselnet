<?php
namespace App\Repository;
use App\Entity\Categories;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class CategoriesRepository
 * @package App\Repository
 */
final class CategoriesRepository 
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
     * CatalogsRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Categories::class);
    }

    /**
     * @return Categories|null
     * @param array $where
     */
    public function findOneBy($where): ?Categories
    {        
        return $this->objectRepository->findOneBy($where);              
    }

    /**
     * @return array
     */
    public function findBy($where): array
    {
        return $this->objectRepository->findBy($where);
    }
}