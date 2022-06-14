<?php

declare(strict_types=1);


namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductUpdateController extends AbstractController
{
    #[Route('/admin/product/update/{productId}', name: 'app_admin_product_update')]
    public function __invoke(string $productId, Request $request, EntityManagerInterface $entityManager)
    {
        $product = $entityManager->getRepository(Product::class)->findOneBy(['id' => $productId]);

        if (empty($product)) {
            $this->addFlash('error', 'Product does not exsists');
            return $this->redirectToRoute('app_admin_product_index');
        }
        $form = $this->createForm(ProductType::class, $product)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Product modified.');
            return $this->redirectToRoute('app_admin_product_index');
        }

        return $this->render('admin/product/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
