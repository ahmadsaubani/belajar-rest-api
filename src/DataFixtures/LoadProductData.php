<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $supplier = $this->getReference('supplier-1');

        $jenisProduct = "Minuman";
        $namaProduct = "teh";
        $status = "tersedia";

        for ($i=1;$i<=5;$i++)
        {
            $product = new Product();
            $product->setKodeProduct($faker->swiftBicNumber);
            $product->setKodeSupplier($faker->numberBetween(100,2000));
            $product->setJenisProduct($jenisProduct);
            $product->setNamaProduct($namaProduct);
            $product->setHargaProduct($faker->randomNumber(4));
            $product->setStatus($status);
            $product->setSupplier($supplier);

            $manager->persist($product);
            $this->addReference('product-'.$i, $product);            
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
