<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use App\Entity\ProductVat;
use App\Form\ProductVatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatIndexController extends AbstractController
{
    #[Route('/admin/vat', name: 'app_admin_vat_index')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $vats = $entityManager->getRepository(ProductVat::class)->findAll();
        return $this->render('admin/vat/index.html.twig', [
            'vats' => $vats
        ]);
    }
}