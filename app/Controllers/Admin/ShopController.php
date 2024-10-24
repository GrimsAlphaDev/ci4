<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ShopController extends BaseController
{
    public function index(): void
    {
        echo "This is an Admin Shop Area";
    }

    public function product($type, $product_id): void
    {
        echo "<h2>This is an admin Product with product: $type and id: $product_id </h2>";
        // return view('product');
    }

}
