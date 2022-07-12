<?php

declare(strict_types=1);


namespace App\Controller\Admin\Delivery;

use App\Entity\Delivery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDeliveryIndexController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/admin/delivery', name: 'app_admin_delivery_index')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $deliveries = $entityManager->getRepository(Delivery::class)->findAll();
        return $this->render('admin/delivery/index.html.twig', [
            'deliveries' => $deliveries
        ]);
    }
}