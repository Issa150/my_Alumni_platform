<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function findAllByRole(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM user
        WHERE (JSON_CONTAINS(roles, :role) = 1 AND JSON_LENGTH(roles) = 1)
        OR roles IS NULL
        OR roles = "[]"
    ';

        $stmt = $conn->executeQuery($sql, ['role' => json_encode('ROLE_USER')]);

        return $stmt->fetchAllAssociative();
    }

    public function findOneById($id): ?User
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }



    public function findLastThree(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM user
        WHERE JSON_CONTAINS(roles, :role) = 1
        ORDER BY id DESC
        LIMIT 3
    ';
        $stmt = $conn->executeQuery($sql, ['role' => json_encode('ROLE_USER')]);

        return $stmt->fetchAllAssociative();
    }



    public function findByNumberAlumnis(): int
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT COUNT(*) as count FROM user
        WHERE (JSON_CONTAINS(roles, :role) = 1 AND JSON_LENGTH(roles) = 1)
        OR roles IS NULL
        OR roles = "[]"
    ';

        $stmt = $conn->executeQuery($sql, ['role' => json_encode('ROLE_USER')]);

        $result = $stmt->fetchOne();

        return (int) $result;
    }
}
