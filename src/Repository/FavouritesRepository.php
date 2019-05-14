<?php
namespace App\Repository;
use App\Entity\Favourites;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Class FavouritesRepository
 * @package App\Repository
 */
final class FavouritesRepository 
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
     * FavouritesRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Favourites::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return Favourites|null
     * @param array $where
     */
    public function findOneBy($where): ?Favourites
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
     * @param Favourites $favourite
     */
    public function save(Favourites $favourite): void
    {
        $this->entityManager->persist($favourite);
        $this->entityManager->flush();
    }

    /**
     * @param Favourites $favourite
     */
    public function delete(Favourites $favourite): void
    {
        $this->entityManager->remove($favourite);
        $this->entityManager->flush();
    }
}