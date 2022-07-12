<?php

declare(strict_types=1);


namespace App\Controller\Admin\Delivery;

use App\Entity\Delivery;
use App\Form\DeliveryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDeliveryCreateController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    #[Route('/admin/delivery/create', name: 'app_admin_delivery_create')]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $delivery = new Delivery();

        $form = $this->createForm(DeliveryType::class, $delivery)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($delivery);
            $entityManager->flush();
            $this->addFlash('success', 'Delivery has been added');
            return $this->redirectToRoute('app_admin_delivery_index');
        }

        return $this->render('admin/delivery/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}