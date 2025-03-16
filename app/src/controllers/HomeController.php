<?php

namespace src\controllers;

use src\core\Controller;
use src\core\Messages;
use src\core\Model;
use src\core\Validation;

// controller default
class HomeController extends Controller
{
   public function index()
   {
      Messages::setMessage("Sucesso");
      Messages::setErrors(["Erro01", "Erro02", "Erro03"]);

      $viewData["view"] = "home";
      $this->loadView("template", $viewData);
      $this->includeMessage();
      $this->includeErrors();
   }
}
