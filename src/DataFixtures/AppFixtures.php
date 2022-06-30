<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\ProductVat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $vat = $this->entityManager->getRepository(ProductVat::class)->findOneBy(['value' => '23']);
        $category = $this->entityManager->getRepository(ProductCategory::class)->findOneBy(['name' => 'Drink']);
        for ($i = 0; $i <100; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setStock(1000);
            $product->setWeight(100);
            $product->setActive(true);
            $product->setVat($vat);
            $product->setCategory($category);
            $product->setSlug('product '.$i);

            $manager->persist($product);
        }
        $manager->flush();
    }
}
