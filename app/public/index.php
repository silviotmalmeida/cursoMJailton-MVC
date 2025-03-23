<?php
// inicializando a sessão

use src\core\Core;
use src\core\CustomException;

session_start();

// importando as dependências
require_once '../config/config.php';
require_once '../vendor/autoload.php';

// tratamento de exceções
try {
    // inicializando a aplicação
    $core = new Core;
    $core->run();
}
// caso existam exceções não tratadas:
catch (Throwable $exception) {
    // exibe tela de exceção
    (new CustomException($exception))->showExceptionPage();
}
