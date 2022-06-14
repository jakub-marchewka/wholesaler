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

class AdminVatUpdateController extends AbstractController
{
    #[Route('/admin/vat/update/{vatId}', name: 'app_admin_vat_update')]
    public function __invoke(
        string $vatId,
        EntityManagerInterface $entityManager,
        Request $request
    ): RedirectResponse|Response {
        $vat = $entityManager->getRepository(ProductVat::class)->findOneBy(['id' => $vatId]);
        if (empty($vat)) {
            $this->addFlash('error', 'Vat does not exists');
            return $this->redirectToRoute('app_admin_vat_index');
        }
        $form = $this->createForm(ProductVatType::class, $vat)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Vat modified.');
            return $this->redirectToRoute('app_admin_vat_index');
        }

        return $this->render('admin/vat/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}