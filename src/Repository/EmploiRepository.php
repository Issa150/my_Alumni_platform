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


    public function findAllEmplois(): array
    {
        return $this->createQueryBuilder('e')
            ->getQuery()
            ->getResult();
    }


    public function findOneById($id): ?Emploi
    {
        return $this->createQueryBuilder('e')
        ->andWhere('e.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }

    public function findAllPublicationDates(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.publicationDate')
            ->getQuery()
            ->getResult();
    }

    public function findAllDomains(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.field')
            ->getQuery()
            ->getResult();
    }

    public function findAllCities(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.city')
            ->getQuery()
            ->getResult();
    }

    public function findAllSkills(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.skills')
            ->getQuery()
            ->getResult();
    }

    public function findAllTeleworkings(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.teleworking')
            ->getQuery()
            ->getResult();
    }

    public function findAllContracts(): array
    {
        return $this->createQueryBuilder('e')
            ->select('DISTINCT e.contract')
            ->getQuery()
            ->getResult();
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

    public function findAllLogos(): array
{
    return $this->createQueryBuilder('e')
        ->select('DISTINCT e.logo')
        ->where('e.logo IS NOT NULL')
        ->getQuery()
        ->getResult();
}
}
