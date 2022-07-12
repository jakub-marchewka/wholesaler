<?php

declare(strict_types=1);


namespace App\Controller\Shop\Product;

use App\Entity\Product;
use App\Entity\ProductQuestion;
use App\Form\ProductQuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductOfferController extends AbstractController
{
    /**
     * @param string $slug
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return RedirectResponse|Response
     */
    #[Route('/product/{slug}', name: 'app_product_offer')]
    public function __invoke(
        string $slug,
        EntityManagerInterface $entityManager,
        Request $request
    ): RedirectResponse|Response {
        $product = $entityManager->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        if (empty($product)) {
            $this->addFlash('error', 'Product do not exsists');
            return $this->redirectToRoute('app_home');
        }
        $productQuestion = new ProductQuestion();
        $questionForm = $this->createForm(ProductQuestionType::class, $productQuestion)->handleRequest($request);
        return $this->render('shop/product/offer.html.twig', [
            'product' => $product,
            'questionForm' => $questionForm->createView()
        ]);
    }
}