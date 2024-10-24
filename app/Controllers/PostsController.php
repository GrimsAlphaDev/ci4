<?php

namespace App\Controllers;

use App\Models\CustomModel;

class PostsController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->all();
        dd($result);
    }
    public function where()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->where();
        dd($result);
    }

    public function join()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->join();
        dd($result);
    }

    public function like()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->like();
        dd($result);
    }

    public function grouping()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->grouping();
        dd($result);
    }

    public function whereIn()
    {
        $db = db_connect();
        $model = new CustomModel($db);
        $result = $model->whereIn();
        dd($result);
    }

}
