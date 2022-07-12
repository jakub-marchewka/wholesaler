<?php

declare(strict_types=1);

namespace App\Controller\Shop\Files;

use App\Entity\AdminFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileDownloadController extends AbstractController
{

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/files', name: 'app_shop_files')]
    public function __invoke(EntityManagerInterface $entityManager): Response
    {
        $files = $entityManager->getRepository(AdminFile::class)->findAll();
        return $this->render('shop/files/index.html.twig', [
            'files' => $files,
        ]);
    }
}