<?php

namespace src\core;

// use function Composer\Autoload\includeFile;

// classe a ser extendida pelos controllers
class Controller
{
    // método resposável por carregar as views
    public function loadView(string $viewName, array $viewData = array()): void
    {
        // extraindo os dados passados pelo array
        extract($viewData);
        // carregando a view
        include "../src/views/" . $viewName . ".php";
    }

    // método responsável por exibir as mensagens
    public function includeMessage(string $messageIncludePath = "includes/message"): void
    {
        // coletando as mensagens
        $message = Messages::getMessage();
        // se existirem mensagens, faz o include das mensagens
        if ($message) {
            include "../src/views/" . $messageIncludePath . ".php";
        }
    }

    // método responsável por exibir os erros
    public function includeErrors(string $errorsIncludePath = "includes/errors"): void
    {
        // coletando os erros
        $errors = Messages::getErrors();
        // se existirem erros, faz o include dos erros
        if ($errors) {
            include "../src/views/" . $errorsIncludePath . ".php";
        }
    }

    // método para redirecionamento
    public function redirect($view)
    {
        header('Location:' . $view);
        exit;
    }

    //    public function incluir($view){
    //        include "app/views/".$view .".php";
    //    }


}
