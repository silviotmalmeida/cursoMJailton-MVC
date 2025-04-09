<?php

namespace src\core;

use Throwable;

// classe de exceções customizadas
class CustomException
{
    // atributos
    private int $code;
    private string $message;

    // construtor
    public function __construct(Throwable $exception)
    {
        $this->code = $exception->getCode();
        $this->message = $exception->getMessage();
    }

    // função que exibe a tela de exceção correspondente ao código da exceção
    public function showExceptionPage() : void
    {
        // obtendo a mensagem da exceção
        $message = $this->message;
        // se existir tela para o código, carrega tela específica
        if (file_exists("../src/views/includes/exceptionCodePages/" . $this->code . ".php")) {
            require_once "../src/views/includes/exceptionCodePages/" . $this->code . ".php";
        }
        // senão carrega tela genérica
        else {
            require_once "../src/views/includes/exceptionCodePages/500.php";
        }
    }
}
