<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findLast3Comments(){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT comment 
            FROM App\Entity\Comment comment
            ORDER BY comment.createdAt DESC");
            
            $query->setMaxResults(3);
            
        
        
            return $query->getResult();

    }

    // public function findAllAsc(){
    //     $entityManager = $this->getEntityManager();

    //     $query = $entityManager->createQuery(
    //         "SELECT comment 
    //         FROM App\Entity\Comment comment
    //         WHERE comment.createdAt < :datedujour
    //         ORDER BY comment.createdAt"
    //         );
    //         $query->setParameter('datedujour',new \DateTime());
        
    //         return $query->getResult();
    // }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
