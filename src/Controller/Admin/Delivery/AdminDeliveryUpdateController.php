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

class AdminDeliveryUpdateController extends AbstractController
{
    #[Route('/admin/delivery/update/{deliveryId}', name: 'app_admin_delivery_update')]
    public function __invoke(
        string $deliveryId,
        Request $request,
        EntityManagerInterface $entityManager
    ): RedirectResponse|Response {
        $deliveryId = $request->get('deliveryId');

        $delivery = $entityManager->getRepository(Delivery::class)->findOneBy(['id' => $deliveryId]);

        if (empty($delivery)) {
            $this->addFlash('error', 'Delivery do not exists');
            return $this->redirectToRoute('app_admin_delivery_index');
        }

        $form = $this->createForm(DeliveryType::class, $delivery)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Delivery modified');
            return $this->redirectToRoute('app_admin_delivery_index');
        }

        return $this->render('admin/delivery/createUpdate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}