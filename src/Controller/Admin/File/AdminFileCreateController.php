<?php

declare(strict_types=1);

namespace App\Controller\Admin\File;

use App\Entity\AdminFile;
use App\Form\AdminFileType;
use App\Service\Admin\File\AdminFileUploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminFileCreateController extends AbstractController
{
    #[Route('/admin/file/create', name: 'app_admin_file_create')]
    public function __invoke(
        Request $request,
        SluggerInterface $slugger,
        AdminFileUploadService $adminFileUploadService
    ): Response {
        $adminFile = new AdminFile();
        $form = $this->createForm(AdminFileType::class, $adminFile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($adminFileUploadService->upload(
                $form,
                $this->getParameter('admin_file_upload'),
                $adminFile,
                $this->getUser()
            )) {
                $this->addFlash('success', 'File has been uploaded');
                return $this->redirectToRoute("app_admin_file_index");
            }
            $this->addFlash('error', 'Error occured');
        }
        return $this->render("admin/files/create.html.twig", [
            'form' => $form->createView()
        ]);
    }
}
