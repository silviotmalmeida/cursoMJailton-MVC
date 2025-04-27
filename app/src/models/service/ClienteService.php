<?php

namespace src\models\service;

use src\models\dao\ClienteDao;
use src\models\validation\ClienteValidation;

// service para tratamento dos dados do dao
class ClienteService extends Service
{
    //nome do dao
    protected static string $dao = ClienteDao::class;

    //nome da classe de validação
    protected static string $validationClass = ClienteValidation::class;
}
