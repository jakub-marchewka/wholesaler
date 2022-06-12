<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatDeleteController extends AbstractController
{
    #[Route('/admin/vat/delete', name: 'app_admin_vat_delete')]
    public function __invoke()
    {

    }
}