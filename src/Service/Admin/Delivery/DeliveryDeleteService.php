<?php

declare(strict_types=1);


namespace App\Service\Admin\Delivery;

use App\Entity\Delivery;
use Doctrine\ORM\EntityManagerInterface;

class DeliveryDeleteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param string $deliveryId
     * @return bool
     */
    public function delete(string $deliveryId): bool
    {
        $delivery = $this->entityManager->getRepository(Delivery::class)->findOneBy(['id' => $deliveryId]);

        if (empty($delivery)) {
            return false;
        }

        $this->entityManager->remove($delivery);
        $this->entityManager->flush();

        return true;
    }
}