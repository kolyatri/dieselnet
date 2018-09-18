<?php
namespace App\Repository;
use App\Entity\Brands;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class BrandsRepository
 * @package App\Repository
 */
final class BrandsRepository 
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
        $this->objectRepository = $this->entityManager->getRepository(Brands::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
        //return array("Russia","England");
    }
}