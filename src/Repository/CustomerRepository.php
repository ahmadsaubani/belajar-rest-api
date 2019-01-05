<?php

namespace App\Repository;

use App\Entity\Customer;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    private function getQueryBuilder()
    {
        return $this->createQueryBuilder('m');
    }

    public function findOneCustomerByUser(UserInterface $user)
    {
        $qb = $this->getQueryBuilder();

        $qb 
            ->addSelect(['u'])
            ->innerJoin('m.user', 'u')
            ->where('u.id = :uid')
            ->setParameter('uid', $user->getId())
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
