<?php

namespace App\Controllers;

class TestController extends BaseController
{
    public function index(): string
    {
        return "Hello, World!";
    }

    public function show(string $name): string
    {
        return "Hello, $name!";
    }
}
