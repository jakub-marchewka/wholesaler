<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatUpdateController extends AbstractController
{
    #[Route('/admin/vat/update', name: 'app_admin_vat_update')]
    public function __invoke()
    {

    }
}