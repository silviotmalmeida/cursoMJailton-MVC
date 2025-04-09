<?php

namespace src\controllers;

use src\core\Controller;
use src\models\TestModel;

// controller para testes
class TestController extends Controller
{
    public function index(): void
    {
        // enviando dados para a view
        $viewData["view"] = "test";
        $this->loadView("template", $viewData);
    }

    public function all(): void
    {
        // obtendo os dados da model
        $data = TestModel::preparedGet();

        // enviando dados para a view
        $viewData["view"] = "test";
        $viewData["data"] = $data;
        $this->loadView("template", $viewData);
    }
}
