<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSupplierData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $totalSupplier = 4;
        for($i=1;$i<=$totalSupplier;$i++)
        {
            $userSupplier = $this->getReference('user-supplier-'.$i);
            
            $supplier = new Supplier();
            $supplier->setUser($userSupplier);
            $supplier->setNamaToko($faker->name);
            $supplier->setAlamatToko($userSupplier->getAlamatToko());
            $supplier->setJenisToko($userSupplier->getJenisToko());
            $supplier->setSloganToko($userSupplier->getSloganToko());
            $supplier->setEmail($userSupplier->getEmail());
            
            $manager->persist($supplier);
            $this->addReference('supplier-'.$i, $supplier);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
