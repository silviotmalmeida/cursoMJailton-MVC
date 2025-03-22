<?php

namespace src\models;

use src\core\Model;

// model para testes
class TestModel extends Model
{
    // // construtor
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    // método de listagem
    public function all()
    {
        $sql = 'SELECT * FROM test';

        return $this->connection->query($sql)->fetchAll();
    }
}
