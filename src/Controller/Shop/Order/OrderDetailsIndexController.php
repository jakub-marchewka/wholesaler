<?php

declare(strict_types=1);


namespace App\Controller\Shop\Order;

use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderDetailsIndexController extends AbstractController
{

    #[Route('/order/show/details/{orderId}', name: 'app_order_show_details')]
    public function __invoke(string $orderId, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $order = $entityManager->getRepository(Order::class)->findOneBy(['id' => $orderId]);
        if ($order->getUser() != $this->getUser() && !$order->isEmpty()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('shop/order/showDetails.html.twig', [
            'order' => $order,
        ]);
    }
}