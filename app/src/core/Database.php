<?php

namespace src\core;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

// classe que vai encapsular toda a lógica de conexão ao banco de dados
class Database
{
    // atributos
    private static ?PDO $connection = null;

    // função que cria a conexão
    public static function getConnection(): PDO
    {
        // lendo informações do env.ini
        // o dirname(__FILE__) fornece o caminho do arquivo atual
        $envPath = realpath(dirname(__FILE__) . '/../../config/env.ini');
        $envFile = parse_ini_file($envPath);

        // tratamento de exceções
        try {
            // se a conexão não existir, cria a conexão (singleton)
            if (!self::$connection) {
                self::$connection = new PDO("mysql:dbname=" . $envFile['mysql_DB'] . ";host=" . $envFile['mysql_IP'], $envFile['mysql_user'], $envFile['mysql_password']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->exec("SET NAMES UTF8");
            }
            // retorna a conexão
            return self::$connection;
        }
        // senão, lança exceção
        catch (PDOException $e) {
            throw new Exception("Erro ao tentar conectar com o banco de dados");
        }
    }

    // função que fecha a conexão
    public static function closeConnection(): void
    {
        self::$connection = null;
    }

    //função que realiza uma consulta e retorna o resultado
    public static function getResultFromQuery(string $sql): PDOStatement|false
    {
        //criando a conexão
        $conn = self::getConnection();

        //realizando a consulta
        $result = $conn->query($sql);

        //fechando a conexão
        self::closeConnection();

        return $result;
    }

    //função que executa uma query e retorna o id de inserção,
    //caso seja uma query de inserção, senão retorna false
    public static function executeSQL(string $sql) : string|false
    {

        //criando a conexão
        $conn = self::getConnection();

        //executando a query
        $result = $conn->exec($sql);

        //obtendo o id, caso seja uma operação de inserção
        $id = $conn->lastInsertId();

        //fechando a conexão
        self::closeConnection();

        return $id;
    }
}
