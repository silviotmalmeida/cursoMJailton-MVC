<?php
namespace src\controllers;

use src\core\Controller;
use src\models\service\Service;
use src\core\Messages;
use src\models\service\ClienteService;

class ClienteController extends Controller{
   
    public function index(){
       $dados["view"]  = "Cliente/Index";
       $this->loadView("template", $dados);
    }
    
    public function create(){
        $dados["view"] = "Cliente/Create";
        $this->loadView("template", $dados);
    }
    
    public function edit($id){
        $dados["view"]      = "Cliente/Create";
        $this->loadView("template", $dados);
    }
    
    public function salvar(){
    }
    
    public function excluir($id){
    }
}

