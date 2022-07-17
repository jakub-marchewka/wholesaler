<?php

declare(strict_types=1);


namespace App\Service\Admin\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductDeleteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param string $productId
     * @return bool
     */
    public function delete(string $productId): bool
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);
        if (empty($product)) {
            return false;
        }
        dump($product);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        return true;
    }
}