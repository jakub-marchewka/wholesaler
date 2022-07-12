<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use App\Entity\ProductVat;
use App\Form\ProductVatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatCreateController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    #[Route('/admin/vat/create', name: 'app_admin_vat_create')]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $vat = new ProductVat();
        $form = $this->createForm(ProductVatType::class, $vat)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vat);
            $entityManager->flush();
            $this->addFlash('success', 'Vat has been added');
            return $this->redirectToRoute('app_admin_vat_index');
        }
        return $this->render('admin/vat/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}