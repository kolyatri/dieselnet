<?php
namespace App\Repository;
use App\Entity\Visits;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class VisitsRepository
 * @package App\Repository
 */
final class VisitsRepository 
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
     * VisitsRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Visits::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return Visits|null
     * @param array $where
     */
    public function findOneBy($where): ?Visits
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