<?php

namespace src\controllers;

use src\core\Controller;
use src\models\CategoryModel;

// controller para testes
class CategoryController extends Controller
{
    public function index(): void
    {
        // enviando dados para a view
        $viewData["view"] = "category";
        $this->loadView("template", $viewData);
    }

    public function all(): void
    {
        // obtendo os dados da model
        $data = (new CategoryModel)->all();

        // enviando dados para a view
        $viewData["view"] = "category";
        $viewData["data"] = $data;
        $this->loadView("template", $viewData);
    }
}
