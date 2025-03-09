<?php

namespace src\controllers;

use src\core\Controller;
use src\core\Model;

// controller default
class HomeController extends Controller
{
   public function index()
   {
      $viewData["view"] = "home";
      $this->loadView("template", $viewData);

      $model = new Model();
   }
}
