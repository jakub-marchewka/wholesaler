<?php

declare(strict_types=1);


namespace App\Service\Shop\Subscribtion;

use App\Entity\Product;
use App\Entity\SubscribedProduct;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class SubscribtionSubscribeService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function subscribe(string $productId, User $user): bool
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);
        if (empty($product)) {
            return false;
        }
        if (in_array($user, $product->getSubscribers()->toArray())) {
            $product->removeSubscriber($user);
            $this->entityManager->flush();
            return false;
        }
        $product->addSubscriber($user);
        $this->entityManager->flush();
        return true;
    }
}