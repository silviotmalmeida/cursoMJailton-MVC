<?php

namespace src\models\dao;

use src\core\Model;

// dao para obtenção de dados da model
class ClienteDao extends Model
{
    //nome da tabela no banco de dados
    protected static $tableName = 'clientes';

    //lista de atributos da tabela
    protected static $columns = [
        'id_cliente',
        'nome',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'complemento',
        'celular',
        'sexo',
        'data_nascimento',
        'cpf',
        'email',
        'data_cadastro',
        'observacao',
    ];
}
