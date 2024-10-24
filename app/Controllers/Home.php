<?php

namespace App\Controllers;

use App\Controllers\Admin\ShopController as Admin;
use App\Controllers\ShopController;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    function validation(){
        $shop = new ShopController();
        echo $shop->product('HandPhone', 22);

        $shopAdmin = new Admin();
        echo $shopAdmin->product('laptop', 42);

    }
}
