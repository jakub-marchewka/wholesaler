<?php

declare(strict_types=1);


namespace App\Controller\Shop\Order;

use App\Entity\Order\Order;
use App\Form\OrderType;
use App\Service\Shop\Order\OrderCreateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSetDetailsController extends AbstractController
{
    /**
     * @param Request $request
     * @param OrderCreateService $createService
     * @return RedirectResponse|Response
     */
    #[Route('/order/details', name: 'app_order_set_details')]
    public function __invoke(Request $request, OrderCreateService $createService): RedirectResponse|Response
    {
        if ($this->getUser()->getCart()->getCartProducts()->isEmpty()) {
            $this->addFlash('error', 'Add products to cart.');
            return $this->redirectToRoute('app_cart_index');
        }
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $createService->create($order, $this->getUser());
            return $this->redirectToRoute('app_order_show_details', ['orderId' => $order->getId()]);
        }
        return $this->render('shop/order/details.html.twig', [
            'form' => $form->createView(),

        ]);
        //form details i form order delivery jak formy git setowac wszystko dodac produkty i flushowac
    }
}