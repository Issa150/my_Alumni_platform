<?php

namespace App\Repository;

use App\Entity\Emploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emploi>
 */
class EmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emploi::class);
    }

    //    /**
    //     * @return Emploi[] Returns an array of Emploi objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Emploi
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    
    public function findLastThree(): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function findByNumberEmplois(): int
    {
         // Obtenir la connexion Doctrine
    $conn = $this->getEntityManager()->getConnection();

    // Requête SQL native
    $sql = '
        SELECT COUNT(*) as count FROM emploi
    ';

    $stmt = $conn->executeQuery($sql);

    $result = $stmt->fetchOne();
    
    return (int) $result;
    }
}
