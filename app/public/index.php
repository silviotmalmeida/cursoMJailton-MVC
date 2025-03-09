<?php
// inicializando a sessão
session_start();

// importando as dependências
require_once '../config/config.php';
require_once '../src/helper/helper.php';
require_once '../src/core/Core.php';
require_once '../vendor/autoload.php';

// inicializando a aplicação
$core = new Core;
$core->run();