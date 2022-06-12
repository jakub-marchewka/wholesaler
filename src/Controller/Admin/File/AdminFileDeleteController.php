<?php

declare(strict_types=1);

namespace App\Controller\Admin\File;

use App\Service\Admin\File\AdminFileDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminFileDeleteController extends AbstractController
{
    #[Route('/admin/file/delete', name: 'app_admin_file_delete')]
    public function __invoke(Request $request, AdminFileDeleteService $deleteService): JsonResponse
    {
        $adminFileId = $request->get('adminFileId');
        if (!empty($adminFileId)) {
            if (!$deleteService->delete($adminFileId, $this->getParameter('admin_file_upload'))) {
                return new JsonResponse("bad");
            }
            return new JsonResponse("good");
        }
        return new JsonResponse("bad");
    }
}
