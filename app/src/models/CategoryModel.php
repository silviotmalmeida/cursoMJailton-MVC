<?php

namespace src\models;

use src\core\Model;

// model para testes
class CategoryModel extends Model
{

    // construtor
    public function __construct()
    {
        parent::__construct();
    }

    // método de listagem
    public function all()
    {
        $sql = 'SELECT * FROM categories';

        return $this->connection->query($sql)->fetchAll();
    }
}
