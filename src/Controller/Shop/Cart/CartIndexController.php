<?php

declare(strict_types=1);


namespace App\Controller\Shop\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartIndexController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/cart', name: 'app_cart_index')]
    public function __invoke(): Response
    {
        return $this->render('shop/cart/index.html.twig');
    }
}