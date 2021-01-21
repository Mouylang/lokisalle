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

    public function findByCriteria($category,$price,$city,$checkinAt,$checkoutAt,$capacity){
        $queryBuilder = $this->createQueryBuilder('product');
        $queryBuilder->innerJoin('product.room','room');
        $queryBuilder->innerJoin('room.category','category');
        $queryBuilder->andWhere('product.isSoldOut = false');

        if($price){
            $queryBuilder->andWhere('product.price <= :price')
                ->setParameter('price',$price);
        }
        if($category){
            $queryBuilder->andWhere('category.name = :catName')
            ->setParameter('catName',$category);
        }
        if($capacity){
            $queryBuilder->andWhere('room.capacity = :roomCapacity')
            ->setParameter('roomCapacity',$capacity);
        }
        if($checkinAt){
            $queryBuilder->andWhere('product.checkinAt >= :checkinAt')
            ->setParameter('checkinAt',$checkinAt);
        }
        if($checkoutAt){
            $queryBuilder->andWhere('product.checkoutAt >= :checkoutAt')
            ->setParameter('checkoutAt',$checkoutAt);
        }
        if($city){
            $queryBuilder->andWhere('room.city = :roomCity')
            ->setParameter('roomCity',$city);
        }


        return $queryBuilder->getQuery()->getResult();
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
