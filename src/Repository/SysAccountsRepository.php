<?php
namespace App\Repository;
use App\Entity\SysAccounts;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SysAccountsRepository
 * @package App\Repository
 */
final class SysAccountsRepository 
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
     * CountriesRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(SysAccounts::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @return SysAccounts|null
     * @param array $where
     */
    public function findOneBy($where): ?SysAccounts
    {
        return $this->objectRepository->findOneBy($where);              
    }

    /**
     * @param SysAccounts $sysAccounts
     */
    public function save(SysAccounts $sysAccounts): void
    {
        $this->entityManager->persist($sysAccounts);
        $this->entityManager->flush();
    }
}