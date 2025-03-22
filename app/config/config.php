<?php
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_METHOD', 'index');
define('NAMESPACE_CONTROLLER', 'src\\controllers\\');
define('TIMEZONE',"America/Recife");
define('PATH', realpath('./'));
define("SITE_TITLE","MVC PHP");

define('BASE_URL', 'http://' . $_SERVER["HTTP_HOST"].'/');
define('IMG_URL', "http://". $_SERVER['HTTP_HOST'] . "/UP/");

define("SESSION_LOGIN","usuario_logado");

$config_upload["verifica_extensao"] = false;
$config_upload["extensoes"]         = array(".gif",".jpeg", ".png", ".bmp", ".jpg");
$config_upload["verifica_tamanho"]  = true;
$config_upload["tamanho"]           = 3097152;
$config_upload["caminho_absoluto"]  = realpath('./'). '/';
$config_upload["renomeia"]          = true;
