<?php

declare(strict_types=1);

namespace App\Service;

final class ProductFormatter
{
    public function format(array $products): array
    {
        foreach ($products as &$product) {
            $product['price'] = $product['price']/100;
        }
        return $products;
    }
}