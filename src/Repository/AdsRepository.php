<?php
namespace App\Repository;
use App\Entity\Ads;
use App\Entity\SysAccounts;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AdsRepository
 * @package App\Repository
 */
final class AdsRepository 
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
        $this->objectRepository = $this->entityManager->getRepository(Ads::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->objectRepository->findAll();     
    }

    /**
     * @return Ads|null
     * @param array $where
     */
    public function findOneBy($where): ?Ads
    {        
        return $this->objectRepository->findOneBy($where);              
    }

    /**
     * @return array|null
     * @param SysAccounts|null $sysAccounts
     * @param bool $isOwner
     */
    public function baseFindBy($conditions, $orders): ?array
    {        
        $qb = $this->objectRepository
            ->createQueryBuilder('ads');
        
        foreach($conditions as $condition){            
            $qb = $qb->andWhere($condition);
        }
        foreach($orders as $key => $value){            
            $qb = $qb->orderBy($key, $value);
        }

        $qb = $qb->getQuery();

        return $qb->execute();        
    }    

    /**
     * @param Ads $ads
     */
    public function save(Ads $ads): void
    {
        $this->entityManager->persist($ads);
        $this->entityManager->flush();
    }
}