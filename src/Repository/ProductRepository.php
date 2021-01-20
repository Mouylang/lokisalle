<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByCategory($category,$price, $checkinAt,$checkoutAt,$capacity ){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT product
            FROM App\Entity\Product product
            INNER JOIN product.room room
            INNER JOIN room.category category
            WHERE category.name = :catName and product.price < :price and :checkinat < product.checkinAt AND :checkoutat > product.checkoutAt  and :capacity < room.capacity '
            )->setParameter('catName', $category)
            ->setParameter('price',$price)
            ->setParameter('checkinat', $checkinAt)
            ->setParameter('checkoutat', $checkoutAt)
            ->setParameter('capacity', $capacity);
        
        
            return $query->getResult();

    }

    public function findNext3availableProducts(){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT product 
            FROM App\Entity\Product product
            WHERE product.checkinAt > :datedujour AND product.isSoldOut = false
            ORDER BY product.checkinAt"
            );
            $query->setParameter('datedujour',new \DateTime());
            $query->setMaxResults(3);
        
        
        
            return $query->getResult();

    }


    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
