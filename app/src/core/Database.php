<?php

namespace src\core;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

// classe que vai encapsular toda a lógica de conexão ao banco de dados
abstract class Database
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

        // tratamento de exceções
        try {

            //realizando a consulta
            $result = $conn->query($sql);
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }

        return $result;
    }

    //função que executa uma query e retorna o id de inserção,
    //caso seja uma query de inserção, senão retorna false
    public static function executeSQL(string $sql): string|false
    {
        //criando a conexão
        $conn = self::getConnection();

        // tratamento de exceções
        try {

            //executando a query
            $result = $conn->exec($sql);

            //obtendo o id, caso seja uma operação de inserção
            $id = $conn->lastInsertId();
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }

        return $id;
    }

    //função que realiza uma consulta e retorna o resultado
    public static function getResultFromPreparedQuery(string $maskedSql, array $keyValuesArray): PDOStatement|false
    {
        //criando a conexão
        $conn = self::getConnection();

        //preparando a consulta
        $result = $conn->prepare($maskedSql);

        // tratamento de exceções
        try {
            // inserindo os valores da consulta
            foreach ($keyValuesArray as $chave => $valor) {
                $result->bindValue(":$chave", $valor);
            }
            // executando a consulta
            $result->execute();
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }

        return $result;
    }

    //função que realiza uma inserção e retorna o id
    public static function executePreparedInsertQuery(string $maskedSql, array $keyValuesArray): int|false
    {
        //criando a conexão
        $conn = self::getConnection();

        //preparando a inserção
        $result = $conn->prepare($maskedSql);

        // tratamento de exceções
        try {
            // inserindo os valores da inserção
            foreach ($keyValuesArray as $key => $value) {
                $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $result->bindValue(":$key", $value, $type);
            }
            // executando a inserção, em caso de sucesso retorna o id
            if($result->execute()){
                return $conn->lastInsertId();
            }
            // senão retorna false
            else{
                return false;
            }
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }
    }

    //função que realiza uma alteração
    public static function executePreparedUpdateQuery(string $maskedSql, array $keyValuesArray): int
    {
        //criando a conexão
        $conn = self::getConnection();

        //preparando a alteração
        $result = $conn->prepare($maskedSql);

        // tratamento de exceções
        try {
            // inserindo os valores da alteração
            foreach ($keyValuesArray as $key => $value) {
                $result->bindValue(":$key", $value);
            }
            // executando a alteração
            $result->execute();
            return $result->rowCount();
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }
    }

    //função que realiza uma exclusão
    public static function executePreparedDeleteQuery(string $maskedSql, array $keyValuesArray): int
    {
        //criando a conexão
        $conn = self::getConnection();

        //preparando a alteração
        $result = $conn->prepare($maskedSql);

        // tratamento de exceções
        try {
            // inserindo os valores da alteração
            foreach ($keyValuesArray as $key => $value) {
                $result->bindValue(":$key", $value);
            }
            // executando a alteração
            $result->execute();
            return $result->rowCount();
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }
    }

    //função que lista as tabelas do bd
    public static function getTables(): array
    {
        // inicializando o array de saída
        $output = [];

        // lendo informações do env.ini
        // o dirname(__FILE__) fornece o caminho do arquivo atual
        $envPath = realpath(dirname(__FILE__) . '/../../config/env.ini');
        $envFile = parse_ini_file($envPath);

        //criando a conexão
        $conn = self::getConnection();

        // tratamento de exceções
        try {

            //realizando a consulta
            $result = $conn->query("SHOW TABLES FROM " . $envFile['mysql_DB']);
        }
        // em caso de erros, lança exceção
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        // ações finais
        finally {
            //fechando a conexão
            self::closeConnection();
        }

        //varrendo os resultados
        $output = $result->fetch(PDO::FETCH_NUM);

        return $output;
    }
    
    // // função para fazer consultas utilizando parametros
    // function query(string $sql, array $params = [], bool $isList = true): mixed
    // {
    //     // preparando a consulta
    //     $stmt = $this->connection->prepare($sql);
    //     // se os filtros não forem passados, lança exceção
    //     if (!$params) {
    //         throw new  Exception("É necessário enviar os parâmetros para o método consultar");
    //     }
    //     // tratamento de exceções
    //     try {
    //         // inserindo os filtros da consulta
    //         foreach ($params as $chave => $valor) {
    //             $stmt->bindValue(":$chave", $valor);
    //         }
    //         // executando a consulta
    //         $stmt->execute();
    //         // definindo o retorno como array de objetos
    //         if ($isList) {
    //             return $stmt->fetchAll(PDO::FETCH_OBJ);
    //         }
    //         // definindo retorno como objeto simples
    //         else {
    //             return $stmt->fetch(PDO::FETCH_OBJ);
    //         }
    //     }
    //     // em caso de erros, lança exceção
    //     catch (PDOException $e) {
    //         throw new Exception($e->getMessage());
    //     }
    // }

    // //Serve para fazer consultas diversas, sem parâmetros
    // function select($conn, $sql, $isLista=true ){
    //     try {
    //         $stmt = $conn->query($sql);
    //         if($isLista){
    //             return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //         }else{
    //             return $stmt->fetch(\PDO::FETCH_OBJ);
    //         }
    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // }

    // //Retorna uma lista da tabela
    // function all($conn, $table =null){
    //     $table = ($table) ? $table: $this->table;
    //     try {
    //         $sql = "SELECT * FROM ". $table;
    //         $stmt = $conn->query($sql);
    //         return $stmt->fetchAll(PDO::FETCH_OBJ);

    //     }catch (PDOException $e){
    //         throw new Exception($e->getMessage());
    //     }
    // }

    // //Retorna uma consulta por um campo
    // function find($conn, $campo, $valor, $tabela=null, $isLista=false ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     try {
    //         $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " =:campo " ;
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(":campo", $valor);
    //         $stmt->execute();
    //         if($isLista){
    //             return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //         }else{
    //             return $stmt->fetch(\PDO::FETCH_OBJ);
    //         }

    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // }    

    // //Retorna uma consulta por um campo
    // function findGeral($conn, $campo, $operador, $valor, $tabela=null, $isLista=false ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     try {
    //         $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . $operador . " :campo " ;
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(":campo", $valor);
    //         $stmt->execute();
    //         if($isLista){
    //             return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //         }else{
    //             return $stmt->fetch(\PDO::FETCH_OBJ);
    //         }

    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // } 

    // //Retorna uma consulta por um campo
    // function findLike($conn, $campo, $valor, $tabela=null, $isLista=false, $posicao=null ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     try {
    //         $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo .  " like :campo " ;
    //         $stmt = $conn->prepare($sql);
    //         if(!$posicao){
    //             $stmt->bindValue(":campo", "%". $valor."%");
    //         }else{
    //             if($posicao==1){
    //                 $stmt->bindValue(":campo", $valor."%");
    //             }else{
    //                 $stmt->bindValue(":campo", "%". $valor);
    //             }
    //         }

    //         $stmt->execute();
    //         if($isLista){
    //             return $stmt->fetchAll(\PDO::FETCH_OBJ);
    //         }else{
    //             return $stmt->fetch(\PDO::FETCH_OBJ);
    //         }

    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // }

    // function findAgrega($conn, $tipo, $campoAgregacao, $tabela=null , $campo = null, $valor =null  ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     try {
    //         if($campo!=null && $valor!=null){
    //             $condicao = " WHERE " . $campo . " =:campo ";
    //         }else{
    //             $condicao = "";
    //         }

    //         if($tipo=="soma"){
    //             $sql = "SELECT sum($campoAgregacao) as soma FROM ". $tabela .$condicao;
    //         }else if($tipo=="total"){
    //             $sql = "SELECT count($campoAgregacao) as total FROM ". $tabela .$condicao;
    //         }else if($tipo=="media"){
    //             $sql = "SELECT avg($campoAgregacao) as media FROM ". $tabela .$condicao;
    //         }else if($tipo=="max"){
    //             $sql = "SELECT max($campoAgregacao) as max FROM ". $tabela .$condicao;
    //         }else if($tipo=="min"){
    //             $sql = "SELECT min($campoAgregacao) as min FROM ". $tabela .$condicao;
    //         }
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(":campo", $valor);
    //         $stmt->execute();
    //         return $stmt->fetch(\PDO::FETCH_OBJ);            

    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // }

    // //Retorna uma consulta por um campo
    // function findEntre($conn, $campo, $valor1, $valor2, $tabela=null ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     try {
    //         $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " between  :valor1 AND :valor2 " ;
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(":valor1", $valor1);
    //         $stmt->bindValue(":valor2", $valor2);
    //         $stmt->execute();
    //         return $stmt->fetchAll(\PDO::FETCH_OBJ);


    //     }catch (\PDOException $e){
    //         throw new \Exception($e->getMessage());
    //     }
    // } 

    // function add($conn, $dados, $tabela=null ){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     if(!$dados){
    //         throw new Exception("É necessário enviar os parâmetros para o método add");
    //     }

    //     if(!is_array($dados)){
    //         throw new Exception("Para poder inserir os dados os valores precisam está em forma de array");
    //     }
    //     try {
    //         $campos 	= implode(", " , array_keys($dados));
    //         $valores 	= ":" . implode(", :" , array_keys($dados));
    //         $sql = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores}) ";
    //         $stmt = $conn->prepare($sql);
    //         foreach($dados as $chave=>$valor){
    //             $stmt->bindValue(":$chave", $valor);
    //         }
    //         if ($stmt->execute()){
    //             return $conn->lastInsertId();
    //         }
    //         return false;
    //     } catch (Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }
    // }

    // function edit($conn, $dados, $campo, $tabela =null){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;
    //     $parametro = null;

    //     if(!$dados){
    //         throw new Exception("É necessário enviar os parâmetros para o método edit");
    //     }

    //     if(!is_array($dados)){
    //         throw new Exception("Para poder editar os dados os valores precisam está em forma de array");
    //     }

    //     try {
    //         foreach($dados as $chave=>$valor){
    //             $parametro .="$chave=:$chave, ";
    //         }
    //         $condicao = $campo ." = " . $dados[$campo];
    //         $parametro = rtrim($parametro, ', ');

    //         $sql = "UPDATE {$tabela} SET {$parametro} WHERE {$condicao} ";
    //         $stmt = $conn->prepare($sql);
    //         foreach($dados as $chave=>$valor){
    //             $stmt->bindValue(":$chave", $valor);
    //         }
    //         $stmt->execute();
    //         return $stmt->rowCount() ;
    //     } catch (Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }        
    // }

    // function del($conn, $campo, $valor,$tabela=null){
    //     $tabela = ($tabela) ? $tabela: $this->tabela;

    //     if(!$campo || !$valor){
    //         throw new Exception("É necessário enviar o campo e o valor para fazer a exclusão");
    //     }
    //     try {
    //         $sql  = "DELETE FROM {$tabela} WHERE {$campo} = :valor";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(":valor", $valor);
    //         $stmt->execute();
    //         return $stmt->rowCount() ;
    //     } catch (Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }

    // }
}
