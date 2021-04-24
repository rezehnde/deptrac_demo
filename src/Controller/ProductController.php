<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product', name: 'product')]
final class ProductController
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function __invoke(): Response
    {
        $products = $this->productRepository->findAll();

        $productsAsArray = array_map(
            static fn (Product $product) => $product->toArray(),
            $products
        );

        return new Response(json_encode($productsAsArray), Response::HTTP_OK, [
            'Content-Type' => 'application/json',
        ]);
    }
}
