<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends Fixture
    implements ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $faker;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->createCustomerUser();
        $this->createSupplierUser();

        $manager->flush();
    }


    /**
     * Get Order
     *
     * @return int $orderNumber
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * Create User's Member
     *
     * @return void
     */
    private function createCustomerUser()
    {
        $totalMember = 4;
        $userManager = $this->container->get('fos_user.user_manager');

        for($i=1;$i<=$totalMember;$i++)
        {
            $number = str_pad($i, 3, '0', STR_PAD_LEFT);
            $user = $userManager->createUser();
            $user->setName($this->faker->name);
            $user->setEnabled(true);
            // $user->setPhoneCountryCode(62);
            $user->setPlainPassword('password');
            if (1 === $i) {
                $user->setUsername('customer');
            } else {
                $user->setUsername($this->faker->username);
            }
            $user->setEmail($this->faker->email);
            $userManager->updateUser($user, true);

            $this->addReference('user-customer-'.$i, $user);
        }
    }

    /**
     * Create User Supplier
     * 
     * @return void
     */
    private function createSupplierUser()
    {
        $totalSupplier = 4;
        $userManager = $this->container->get('fos_user.user_manager');

        for($i=1;$i<=$totalSupplier;$i++)
        {
            $number = str_pad($i, 3, '0', STR_PAD_LEFT);
            $user = $userManager->createUser();
            $user->setNamaToko($this->faker->name);
            $user->setAlamatToko($this->faker->address);
            $user->setJenisToko($this->faker->name);
            $user->setSloganToko($this->faker->text);
            $user->setEnabled(true);
            // $user->setPhoneCountryCode(62);
            $user->setPlainPassword('password');
            if (1 === $i) {
                $user->setUsername('Supplier');
            } else {
                $user->setUsername($this->faker->username);
            }
            $user->setEmail($this->faker->email);
            $userManager->updateUser($user, true);

            $this->addReference('user-supplier-'.$i, $user);
        }
    }
}
