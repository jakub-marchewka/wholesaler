<?php

declare(strict_types=1);


namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductCreateController extends AbstractController
{
    #[Route('/admin/product/create', name: 'app_admin_product_create')]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Product has been added');
            return $this->redirectToRoute("app_admin_product_index");
        }
        return $this->render('admin/product/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}