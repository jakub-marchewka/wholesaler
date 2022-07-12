<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Entity\Product;
use App\Service\Core\PaginatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorService $paginator,
        Request $request
    ): Response {
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {
            return $this->render('home/notLogged.html.twig');
        }
        $products = $entityManager->getRepository(Product::class)->findAll();
        return $this->render('home/logged.html.twig', [
            'products' => $paginator->paginate(
                $entityManager->getRepository(Product::class)->findAll(),
                $request
            ),
        ]);
    }
}
