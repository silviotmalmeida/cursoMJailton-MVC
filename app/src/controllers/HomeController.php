<?php

namespace src\controllers;

use src\core\Controller;

class HomeController extends Controller
{

   public function index()
   {
      $dados["view"]   = "home";
      $this->loadView("template", $dados);
   }
}
