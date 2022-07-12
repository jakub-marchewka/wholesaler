<?php

declare(strict_types=1);


namespace App\Service\Admin\Vat;

use App\Entity\ProductVat;
use Doctrine\ORM\EntityManagerInterface;

class ProductVatDeleteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param string $vatId
     * @return bool
     */
    public function delete(string $vatId): bool
    {
        $vat = $this->entityManager->getRepository(ProductVat::class)->findOneBy(['id' => $vatId]);

        if (!empty($vat)) {
            $this->entityManager->remove($vat);
            $this->entityManager->flush();
            return true;
        }

        return false;
    }
}