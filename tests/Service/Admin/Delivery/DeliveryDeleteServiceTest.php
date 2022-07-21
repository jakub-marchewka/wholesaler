<?php

declare(strict_types=1);

namespace App\Tests\Service\Admin\Delivery;

use App\Repository\DeliveryRepository;
use App\Service\Admin\Delivery\DeliveryDeleteService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DeliveryDeleteServiceTest extends KernelTestCase
{
    public function testDeleteWhenProductExists()
    {
        self::bootKernel();
        $container = static::getContainer();
        $deliveryDeleteService = $container->get(DeliveryDeleteService::class);
        $deliveryRepository = $container->get(DeliveryRepository::class);
    }
}
