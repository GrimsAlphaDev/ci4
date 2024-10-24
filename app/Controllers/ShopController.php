<?php

namespace App\Controllers;

class ShopController extends BaseController
{
    public function index(): string
    {
        return view('shop');
    }

    public function product($type = 'pc', $product_id = 12): void
    {
        echo "<h2>This is a product: $type with an id: $product_id</h2>";
        // return view('product');
    }

}
