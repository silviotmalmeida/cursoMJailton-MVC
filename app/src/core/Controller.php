<?php

namespace src\core;

// use function Composer\Autoload\includeFile;

// classe a ser extendida pelos controllers
class Controller
{
    // método resposável por carregar as views
    public function loadView(string $viewName, array $viewData = array()) : void
    {
        // extraindo os dados passados pelo array
        extract($viewData);
        // carregando a view
        include "../src/views/" . $viewName . ".php";
    }

    //    public function verMsg($view=null){
    //        $view = ($view) ? $view : "inc/msg";
    //        $msg = Flash::getMsg();
    //        if($msg){
    //         include "app/views/".$view .".php";
    //        }
    //    }

    //    public function verErro($view=null){
    //        $view = ($view) ? $view : "inc/erros";
    //        $erros = Flash::getErro();
    //        if($erros){
    //            include "app/views/".$view .".php";
    //        }
    //    }

    //    public function redirect($view) {
    //        header('Location:' . $view);
    //        exit;
    //    }

    //    public function incluir($view){
    //        include "app/views/".$view .".php";
    //    }


}
