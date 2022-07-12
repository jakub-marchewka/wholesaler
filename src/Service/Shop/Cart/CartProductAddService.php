<?php

declare(strict_types=1);


namespace App\Service\Shop\Cart;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Entity\Product;
use App\Entity\Response;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CartProductAddService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param string $productId
     * @param User $user
     * @return Response
     */
    public function add(string $productId, User $user): Response
    {
        $cart = $this->entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);
        if (empty($cart)) {
            $cart = new Cart();
            $cart->setUser($user);
            $this->entityManager->persist($cart);
        }
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);
        if (empty($product)) {
            return new Response(false, 'Product do not exsists.');
        }
        if ($product->getStock()<1) {
            return new Response(false, 'No enough in stock.');
        }
        $cartProduct = $this->entityManager
            ->getRepository(CartProduct::class)
            ->findOneBy(['cart' => $cart, 'product' => $product]);
        if (empty($cartProduct)) {
            $cartProduct = new CartProduct();
            $cartProduct->setCart($cart);
            $cartProduct->setProduct($product);
            $cartProduct->setQuantity(1);
            $this->entityManager->persist($cartProduct);
        } else {
            $cartProduct->setQuantity($cartProduct->getQuantity()+1);
        }
        $this->entityManager->flush();
        return new Response(true, 'Product has been added to cart.');
    }
}
