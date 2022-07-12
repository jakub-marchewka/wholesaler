<?php

declare(strict_types=1);


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('displayPrice', [$this, 'price']),
        ];
    }

    /**
     * @param int $price
     * @return float|int
     */
    public function price(int $price): float|int
    {
        return (float)$price/100;
    }
}