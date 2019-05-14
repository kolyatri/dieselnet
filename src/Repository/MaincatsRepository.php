<?php
namespace App\Repository;
use App\Entity\Maincats;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class MaincatsRepository
 * @package App\Repository
 */
final class MaincatsRepository 
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
        $this->objectRepository = $this->entityManager->getRepository(Maincats::class);
    }

    /**
     * @return Maincats|null
     * @param array $where
     */
    public function findOneBy($where): ?Maincats
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