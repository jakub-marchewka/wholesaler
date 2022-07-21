<?php

declare(strict_types=1);


namespace App\Controller\Api\Product;

use App\Entity\Product;
use App\Entity\UserApiToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class GetProductController extends AbstractController
{
    #[Route('/api/products/get', name: 'api_products_get', methods: 'get')]
    public function __invoke(
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer): JsonResponse {
        $token = $request->headers->get('Token');
        if (empty($token)) {
            return new JsonResponse(['status' => 'error', 'error' => 'Put token in header', 'products' => []]);
        }
        $tokenExist = $entityManager->getRepository(UserApiToken::class)->findOneBy(['token' => $token]);

        if (empty($tokenExist)) {
            return new JsonResponse(['status' => 'error', 'error' => 'Invalid token', 'products' => []]);
        }
        
        $products = $entityManager->getRepository(Product::class)->findAll();
        $jsonProducts = $serializer->serialize($products, 'json');
        return new JsonResponse(['status' => 'success', 'error' => '', 'products' => $jsonProducts]);
    }
}
