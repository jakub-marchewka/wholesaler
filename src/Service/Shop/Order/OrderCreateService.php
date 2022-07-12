<?php

declare(strict_types=1);


namespace App\Service\Shop\Order;

use App\Entity\Cart;
use App\Entity\Order\Order;
use App\Entity\Order\OrderProduct;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class OrderCreateService
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function create(Order $order, User $user)
    {
        $order->setUser($user);
        $order->setCreatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        $cart = $this->entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);
        $cartProducts = $cart->getCartProducts();
        $this->entityManager->flush($order);
        foreach ($cartProducts as $cartProduct) {
            $orderProduct = new OrderProduct();
            $orderProduct->setQuantity($cartProduct->getQuantity());
            $orderProduct->setProduct($cartProduct->getProduct());
            $orderProduct->setOrderEntity($order);
            $this->entityManager->persist($orderProduct);
            $cart->removeCartProduct($cartProduct);
        }
        $this->entityManager->flush();
    }
}