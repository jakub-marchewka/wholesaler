<?php

declare(strict_types=1);

namespace App\Service\Shop\Search;

use App\Repository\ProductRepository;

class SearchService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function search(string $name): ?array
    {
        return $this->productRepository->findWithName($name);
    }
}
