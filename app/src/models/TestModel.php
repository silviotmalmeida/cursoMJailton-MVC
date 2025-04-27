<?php

namespace src\models;

use src\core\Model;

// model para testes
class TestModel extends Model
{
    //nome da tabela no banco de dados
    protected static string $tableName = 'test';

    //lista de atributos da tabela
    protected static array $columns = [
        'id',
        'name',
        'email',
        'profession',
    ];

    // chave primária da tabela
    protected static string $primaryKey = 'id';
}
