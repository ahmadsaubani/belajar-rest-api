<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    private function getQueryBuilder()
    {
        return $this->createQueryBuilder('mo');
    }

    // public function findOneProductByCustomer(Customer $customer)
    // {
    //     $qb = $this->getQueryBuilder();

    //     $qb 
    //         ->addSelect(['u'])
    //         ->innerJoin('m.customer', 'u')
    //         ->where('u.id = :uid')
    //         ->setParameter('uid', $customer->getId())
    //     ;

    //     return $qb->getQuery()->getOneOrNullResult();   
    //  }
}
