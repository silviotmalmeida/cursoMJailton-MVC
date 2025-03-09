<?php

namespace src\core;

use Exception;
use PDO;
use PDOException;

// classe de conexão com o bd
class Connection
{

    // atributos
    private static ?PDO $connection = null;

    // método de conexão
    public static function connect(): PDO
    {

        // tratamento de exceções
        try {
            // se a conexão for bem sucedida, retorna a conexão
            if (!self::$connection) {
                self::$connection = new PDO("mysql:dbname=" . MYSQL_DB . ";host=" . MYSQL_IP, MYSQL_USER, MYSQL_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->exec("SET NAMES " . CHARSET);
            }
            return self::$connection;
        }
        // senão, lança exceção
        catch (PDOException $e) {
            throw new Exception("Erro ao tentar conectar com o banco");
        }
    }
}
