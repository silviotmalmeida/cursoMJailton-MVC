<?php

namespace src\models\dao;

use src\core\Model;

// dao para obtenção de dados da model
class ClienteDao extends Model
{
    //nome da tabela no banco de dados
    protected static string $tableName = 'clientes';

    //lista de atributos da tabela
    protected static array $columns = [
        'id_cliente',
        'nome',
        'cep',
        'endereco',
        'complemento',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'celular',
        'cpf',
        'sexo',
        'data_nascimento',
        'email',
        'senha',
        'observacao',
        'data_cadastro',
    ];

    // chave primária da tabela
    protected static string $primaryKey = 'id_cliente';
}
