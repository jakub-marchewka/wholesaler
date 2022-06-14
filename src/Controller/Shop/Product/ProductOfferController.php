<?php

declare(strict_types=1);


namespace App\Controller\Shop\Product;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductOfferController extends AbstractController
{
    #[Route('/product/{slug}', name: 'app_product_offer')]
    public function __invoke(string $slug, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $product = $entityManager->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        if (empty($product)) {
            $this->addFlash('error', 'Product do not exsists');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('shop/product/offer.html.twig', [
            'product' => $product
        ]);
    }
}