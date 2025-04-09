<?php

namespace src\models;

use src\core\Model;

// model para testes
class TestModel extends Model
{
    //nome da tabela no banco de dados
    protected static $tableName = 'test';

    //lista de atributos da tabela
    protected static $columns = [
        'id',
        'name',
        'email',
        'profession',
    ];
}
