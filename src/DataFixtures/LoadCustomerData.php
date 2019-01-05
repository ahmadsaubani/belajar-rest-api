<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCustomerData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $totalMember = 4;
        for($i=1;$i<=$totalMember;$i++)
        {
            $userCustomer = $this->getReference('user-customer-'.$i);
            
            $customer = new Customer();
            $customer->setUser($userCustomer);
            $customer->setName($faker->name);
            $customer->setEmail($userCustomer->getEmail());
            
            $manager->persist($customer);
            $this->addReference('customer-'.$i, $customer);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
