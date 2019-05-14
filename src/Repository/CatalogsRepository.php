<?php
namespace App\Repository;
use App\Entity\Catalogs;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class CatalogsRepository
 * @package App\Repository
 */
final class CatalogsRepository 
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
        $this->objectRepository = $this->entityManager->getRepository(Catalogs::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return Catalogs|null
     * @param array $where
     */
    public function findOneBy($where): ?Catalogs
    {        
        return $this->objectRepository->findOneBy($where);              
    }

}