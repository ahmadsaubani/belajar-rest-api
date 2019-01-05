<?php

namespace App\Repository;

use App\Entity\Supplier;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Supplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supplier[]    findAll()
 * @method Supplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Supplier::class);
    }

    private function getQueryBuilder()
    {
        return $this->createQueryBuilder('m');
    }

    public function findOneSupplierByUser(UserInterface $user)
    {
        $qb = $this->getQueryBuilder();

        $qb 
            ->addSelect(['u'])
            ->innerJoin('m.user', 'u')
            ->where('u.id = :uid')
            ->setParameter('uid', $user->getId())
        ;

        $key = sprintf('supplier_%s', $user);
        $query = $qb->getQuery()->useResultCache(true, 10, $key);

        return $query->getOneorNullResult();  
     }

}
