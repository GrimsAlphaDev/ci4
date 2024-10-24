<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index(): void
    {
        echo '<h2>This is a user page</h2>';
    }

    public function getAllUsers(): void
    {
        echo '<h2>Show all users</h2>';
    }
}