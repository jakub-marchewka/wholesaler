<?php

declare(strict_types=1);


namespace App\Controller\Shop\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderSetDetailsController extends AbstractController
{
    #[Route('/order/details', name: 'app_order_set_details')]
    public function __invoke()
    {
        //form details i form order delivery jak formy git setowac wszystko dodac produkty i flushowac
    }
}