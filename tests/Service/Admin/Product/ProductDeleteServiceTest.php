<?php

namespace App\Tests\Service\Admin\Product;

use App\Repository\ProductRepository;
use App\Service\Admin\Product\ProductDeleteService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class ProductDeleteServiceTest extends KernelTestCase
{
    public function testProductDeleteWhenProductExists()
    {
        self::bootKernel();
        $container = static::getContainer();
        $productDeleteService = $container->get(ProductDeleteService::class);
        $productRepository = $container->get(ProductRepository::class);
        $product = $productRepository->findOneBy(['name' => 'product 1']);
        $productId = $product->getId();
        $productDelete = $productDeleteService->delete($productId);
        $this->assertEquals(true, $productDelete);
    }
}
