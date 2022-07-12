<?php

declare(strict_types=1);


namespace App\Service\Shop\Product;

use App\Entity\Product;
use App\Entity\ProductQuestion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProductQuestionCreateService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Security $security
    ) {
    }

    /**
     * @param ProductQuestion $productQuestion
     * @param string $productId
     * @return bool
     */
    public function create(ProductQuestion $productQuestion, string $productId): bool
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);
        if (empty($product)) {
            return false;
        }

        $productQuestion->setUser($this->security->getUser());
        $productQuestion->setProduct($product);
        $productQuestion->setAnswered(false);
        $this->entityManager->persist($productQuestion);
        $this->entityManager->flush();
        return true;
    }
}