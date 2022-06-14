<?php

declare(strict_types=1);


namespace App\Service\Admin\ProductCategory;

use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManagerInterface;

class ProductCategoryDeleteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function delete(string $id): bool
    {
        $category = $this->entityManager->getRepository(ProductCategory::class)->findOneBy(['id' => $id]);

        if (!empty($category)) {
            $this->entityManager->remove($category);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }
}
