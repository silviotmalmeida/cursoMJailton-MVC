<?php

namespace src\models;

use src\core\Model;
use src\core\Model2;

// model para testes
class TestModel extends Model2
{
    //nome da tabela no banco de dados
    protected static $tableName = 'test';

    //lista de atributos da tabela
    protected static $columns = [
        'id',
        'name',
        'email',
    ];

    // método de listagem
    public function all()
    {
        $sql = 'SELECT * FROM test';

        return $this->connection->query($sql)->fetchAll();
    }
}
