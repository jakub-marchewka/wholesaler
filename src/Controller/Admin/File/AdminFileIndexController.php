<?php

declare(strict_types=1);

namespace App\Controller\Admin\File;

use App\Entity\AdminFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFileIndexController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/admin/file', name: 'app_admin_file_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $files = $entityManager->getRepository(AdminFile::class)->findAll();
        return $this->render('admin/files/index.html.twig', [
            'files' => $files
        ]);
    }
}
