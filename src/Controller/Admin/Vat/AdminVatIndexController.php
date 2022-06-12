<?php

declare(strict_types=1);

namespace App\Controller\Admin\Vat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminVatIndexController extends AbstractController
{
    #[Route('/admin/vat', name: 'app_admin_vat_index')]
    public function __invoke()
    {

    }
}