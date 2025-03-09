<?php

namespace src\controllers;

use src\core\Controller;
use src\core\Messages;
use src\core\Model;

// controller default
class HomeController extends Controller
{
   public function index()
   {
      Messages::setMsg("Home");

      $viewData["view"] = "home";
      $this->loadView("template", $viewData);

      $model = new Model();
   }
}
