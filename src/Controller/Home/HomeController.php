<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Entity\Product;
use App\Form\SearchBarType;
use App\Service\Core\PaginatorService;
use App\Service\Shop\Search\SearchService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param PaginatorService $paginator
     * @param Request $request
     * @param SearchService $searchService
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorService $paginator,
        Request $request,
        SearchService $searchService
    ): Response {
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {
            return $this->render('home/notLogged.html.twig');
        }
        $products = $entityManager->getRepository(Product::class)->findAll();
        $form = $this->createForm(SearchBarType::class, null, ['method' => 'GET'])->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render('shop/search/search.html.twig', [
                'products' => $paginator->paginate(
                    $searchService->search($form->get('search')->getData()),
                    $request
                ),
                'form' => $form->createView()
            ]);
        }
        return $this->render('home/logged.html.twig', [
            'form' => $form->createView(),
            'products' => $paginator->paginate(
                $entityManager->getRepository(Product::class)->findAll(),
                $request
            ),
        ]);
    }
}
