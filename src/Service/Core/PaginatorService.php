<?php

declare(strict_types=1);


namespace App\Service\Core;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginatorService
{
    public function __construct(
        private PaginatorInterface $paginator
    ) {
    }

    public function paginate($query, Request $request): PaginationInterface
    {
        return $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            15
        );
    }
}