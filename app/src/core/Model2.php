<?php

namespace src\core;

use PDO;
use PDOStatement;
use src\helper\Helper;

//classe mãe de todos os models
//possui os métodos genéricos para consumo das classes filhas
class Model2
{
    //definição dos atributos a serem detalhados nas classes filhas
    protected static $tableName = '';
    protected static $columns = [];

    //método construtor
    function __construct(array $arr, bool $sanitize = true)
    {
        //cria um objeto e carrega os atributos a partir de um array chave=>valor
        $this->loadFromArray($arr, $sanitize);
    }

    //função auxiliar que valida e carrega os atributos a partir de um array chave=>valor
    public function loadFromArray(array $arr, bool $sanitize = true): void
    {
        if ($arr) {
            foreach ($arr as $key => $value) {

                //inicializando a variável com o dado a ser sanitizado
                $cleanValue = $value;

                //se a opção de sanitização estiver ativada:
                if ($sanitize && isset($cleanValue)) {
                    //removendo tags html e php e espaços em branco
                    $cleanValue = strip_tags(trim($cleanValue));
                    //convertendo caracteres aplicáveis em entidades html, exceto aspas
                    // $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
                }

                //utilização do set mágico para atribuição
                $this->$key = $cleanValue;
            }
        }
    }

    //função get genérica para um atributo
    //está sendo utilizado o método mágico __get para simplificar a manipulação
    //(ex: ao invés de $user->get('email'), usa-se $user->email
    public function __get($key)
    {
        return $this->$key;
    }

    //função set genérica para um atributo
    //está sendo utilizado o método mágico __set para simplificar a manipulação
    //(ex: ao invés de $user->set('email', 'email@email.com'), usa-se $user->email = 'email@email.com'
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    //função get que retorna um array chave=>valor com os atributos
    public function getValues(): array
    {
        //utilização do get mágico para consulta                
        return Helper::objectToArray($this);
    }

    //funcao que realiza uma consulta e retorna objetos populados com os dados da consulta
    //os filtros referem-se à clausula WHERE. Deve ser passado um array chave=>valor
    //as colunas referem-se aos atributos desejados. Deve ser passado uma string separada por virgulas
    public static function get(
        string $columns = '*',
        array $filters = [],
        string $filterType = 'AND',
        string $orderColumn = '',
        string $orderType = 'ASC',
        int $limit = 0
    ): array {
        // inicializando o array de objetos
        $objects = [];

        //realizando a consulta
        $result = static::getResultSetFromSelect(
            $columns,
            $filters,
            $filterType,
            $orderColumn,
            $orderType,
            $limit
        );

        // se existirem resultados
        if ($result !== false and $result !== null) {

            //obtendo a classe que chamou esta funcao
            //o metodo get_called_class retorna a classe que chamou a funcao
            $class = get_called_class();

            //varrendo os resultados
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {

                //populando o array com os objetos populados
                array_push($objects, new $class(Helper::objectToArray($row)));
            }
        }
        return $objects;
    }

    //função que insere um registro na tabela
    public function insert(array $autocolumns): int
    {
        // removendo as columas que são de autoincremento
        $insertColumns = static::$columns;
        foreach ($autocolumns as $autocolumn) {
            $keyId = array_search($autocolumn, $insertColumns);
            if ($keyId !== false) {
                unset($insertColumns[$keyId]);
            }
        }

        //construindo a query a partir das variáveis estáticas da model
        $sql = "INSERT INTO " . static::$tableName . " ("
            . implode(",", $insertColumns) . ") VALUES (";
        foreach ($insertColumns as $col) {
            $sql .= static::getFormatedValue($this->$col) . ",";
        }

        //substituindo a última vírgula pelo parenteses final
        $sql[strlen($sql) - 1] = ')';

        //executando a query e obtendo o id de inserção
        $id = Database::executeSQL($sql);
        $this->id = $id;

        return $id;
    }

    //função que altera um registro na tabela
    public function update(): void
    {
        //construindo a query a partir das variáveis estáticas da model
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach (static::$columns as $col) {
            $sql .= " ${col} = " . static::getFormatedValue($this->$col) . ",";
        }
        //substituindo a última vírgula por um espaço em branco
        $sql[strlen($sql) - 1] = ' ';

        //inserindo a cláusula where
        $sql .= "WHERE id = {$this->id}";

        //executando a query
        Database::executeSQL($sql);
    }

    // //função que retorna a quantidade de registros de uma consulta
    // public static function getCount(array $filters = []): int
    // {
    //     $result = static::getResultSetFromSelect(
    //         'count(*) as count',
    //         $filters
    //     );
    //     return count($result->fetchAll(PDO::FETCH_OBJ));
    // }

    //função que exclui um registro na tabela
    public function delete(): void
    {
        static::deleteById($this->id);
    }

    //função auxiliar que implementa uma delete query para o id fornecido como atributo
    public static function deleteById(string $id): void
    {
        //contruindo a query
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = $id";

        //executando a query
        Database::executeSQL($sql);
    }

    //função auxiliar que implementa uma select query, retornando o resultado
    private static function getResultSetFromSelect(
        string $columns = '*',
        array $filters = [],
        string $filterType = 'AND',
        string $orderColumn = '',
        string $orderType = 'ASC',
        int $limit = 0
    ): PDOStatement|false|null {
        //construção do comando sql
        $sql = "SELECT ${columns} FROM "

            //o nome da tabela vem do atributo $tableName
            . static::$tableName

            //a validacao da clausula WHERE vem da funcao auxiliar getFilters
            . static::getFilters($filters, $filterType);

        //caso exista coluna de ordenação e os tipos de ordenação forem ASC ou DESC
        if ($orderColumn and ($orderType === 'ASC' or $orderType === 'DESC'))
            $sql = $sql . " ORDER BY $orderColumn $orderType";

        //caso exista limitador de resultados
        if ($limit > 0) $sql = $sql . " LIMIT $limit";

        //realizando a consulta
        $result = Database::getResultFromQuery($sql);

        //retornando os resultados
        if ($result === false) {
            return null;
        } else {
            return $result;
        }
    }

    //função auxiliar que avalia e formata os filtros a serem inseridos na cláusula WHERE
    private static function getFilters(array $filters, string $filterType = 'AND'): string
    {
        //construção da cláusula WHERE        
        $sql = '';

        //só será construída caso existam filtros e se os tipos de filtros forem AND ou OR
        if (count($filters) > 0 and ($filterType === 'AND' or $filterType === 'OR')) {

            //artificio utilizado para existir somente um where na consulta
            // caso o tipo de filtro seja AND:
            if ($filterType === 'AND') {

                // adiciona uma condição que sempre será verdadeira no início
                $sql .= " WHERE 1 = 1";

                // caso o tipo de filtro seja OR:
            } elseif ($filterType === 'OR') {

                // adiciona uma condição que sempre será falsa no início
                $sql .= " WHERE 1 = 0";
            }

            //percorrendo o array de filtros
            foreach ($filters as $column => $value) {

                //se for passado um filtro de chave raw:
                if ($column == 'raw') {

                    //será utilizado o valor diretamente
                    $sql .= " $filterType $value";
                }

                //senão:
                else {

                    //será utilizada a chave como o atributo 
                    $sql .= " $filterType $column = " . static::getFormatedValue($value);
                }
            }
        }

        //retorna os filtros formatados
        return $sql;
    }

    //funcao auxiliar para avaliação dos valores dos filtros
    private static function getFormatedValue(string $value): string
    {
        //se for nulo, retorna null
        if (is_null($value)) {
            return "null";
        }
        //se for string, coloca as aspas simples
        elseif (gettype($value) === 'string') {
            return "'${value}'";
        }
        //senao, simplesmente retorna o valor
        else {
            return $value;
        }
    }

    //funcao que realiza uma consulta e retorna objetos populados com os dados da consulta
    //os filtros referem-se à clausula WHERE. Deve ser passado um array chave=>valor
    //as colunas referem-se aos atributos desejados. Deve ser passado uma string separada por virgulas
    public static function preparedGet(
        string $columns = '*',
        array $filters = [],
        string $filterType = 'AND',
        string $orderColumn = '',
        string $orderType = 'ASC',
        int $limit = 0
    ): array {
        // inicializando o array de objetos
        $objects = [];

        //realizando a consulta
        $result = static::getResultSetFromPreparedSelectQuery(
            $columns,
            $filters,
            $filterType,
            $orderColumn,
            $orderType,
            $limit
        );

        if ($result !== false and $result !== null) {

            //obtendo a classe que chamou esta funcao
            //o metodo get_called_class retorna a classe que chamou a funcao
            $class = get_called_class();

            //varrendo os resultados
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {

                //populando o array com os objetos populados
                array_push($objects, new $class(Helper::objectToArray($row)));
            }
        }
        return $objects;
    }

    //função que insere um registro na tabela
    public function preparedInsert(array $autocolumns): int
    {
        // removendo as columas que são de autoincremento
        $insertColumns = static::$columns;
        foreach ($autocolumns as $autocolumn) {
            $keyId = array_search($autocolumn, $insertColumns);
            if ($keyId !== false) {
                unset($insertColumns[$keyId]);
            }
        }

        //construindo a query a partir das variáveis estáticas da model
        $maskedSql = "INSERT INTO " . static::$tableName . " ("
            . implode(",", $insertColumns) . ") VALUES (";
        foreach ($insertColumns as $col) {
            $maskedSql .= ":" . $col . ",";
        }

        //substituindo a última vírgula pelo parenteses final
        $maskedSql[strlen($maskedSql) - 1] = ')';

        //executando a query e obtendo o id de inserção
        $id = Database::executePreparedInsertQuery($maskedSql, $this->getValues());
        $this->id = $id;

        return $id;
    }

    //função que altera um registro na tabela
    public function preparedUpdate(): void
    {
        //construindo a query a partir das variáveis estáticas da model
        $maskedSql = "UPDATE " . static::$tableName . " SET ";
        foreach (static::$columns as $col) {
            $maskedSql .= " $col = :" . $col . ",";
        }
        //substituindo a última vírgula por um espaço em branco
        $maskedSql[strlen($maskedSql) - 1] = ' ';

        //inserindo a cláusula where
        $maskedSql .= "WHERE id = {$this->id}";

        //executando a query e obtendo o id de inserção
        Database::executePreparedUpdateQuery($maskedSql, $this->getValues());        
    }

    //função que exclui um registro na tabela
    public function preparedDelete(): void
    {
        //construindo a query
        $maskedSql = "DELETE FROM " . static::$tableName . " WHERE id = :id";

        //executando a query e obtendo o id de inserção
        Database::executePreparedDeleteQuery($maskedSql, ["id"=>$this->id]);        
    }

    //função auxiliar que implementa uma prepared select query, retornando o resultado
    private static function getResultSetFromPreparedSelectQuery(
        string $columns = '*',
        array $filters = [],
        string $filterType = 'AND',
        string $orderColumn = '',
        string $orderType = 'ASC',
        int $limit = 0
    ): PDOStatement|false|null {
        //construção do comando sql
        $maskedSql = "SELECT ${columns} FROM "

            //o nome da tabela vem do atributo $tableName
            . static::$tableName

            //a validacao da clausula WHERE vem da funcao auxiliar getFilters
            . static::getPreparedFilters($filters, $filterType);

        //caso exista coluna de ordenação e os tipos de ordenação forem ASC ou DESC
        if ($orderColumn and ($orderType === 'ASC' or $orderType === 'DESC'))
            $maskedSql = $maskedSql . " ORDER BY $orderColumn $orderType";

        //caso exista limitador de resultados
        if ($limit > 0) $maskedSql = $maskedSql . " LIMIT $limit";

        //realizando a consulta
        $result = Database::getResultFromPreparedQuery($maskedSql, $filters);

        //retornando os resultados
        if ($result === false) {
            return null;
        } else {
            return $result;
        }
    }

    //função auxiliar que formata os filtros a serem inseridos na cláusula WHERE
    private static function getPreparedFilters(array $filters, string $filterType = 'AND'): string
    {
        //construção da cláusula WHERE        
        $sql = '';

        //só será construída caso existam filtros e se os tipos de filtros forem AND ou OR
        if (count($filters) > 0 and ($filterType === 'AND' or $filterType === 'OR')) {

            // caso o tipo de filtro seja AND:
            if ($filterType === 'AND') {

                // adiciona uma condição que sempre será verdadeira no início
                $sql .= " WHERE 1 = 1";

                // caso o tipo de filtro seja OR:
            } elseif ($filterType === 'OR') {

                // adiciona uma condição que sempre será falsa no início
                $sql .= " WHERE 1 = 0";
            }

            //percorrendo o array de filtros
            foreach ($filters as $column => $value) {

                //será utilizada a chave como o atributo 
                $sql .= " $filterType $column = :$column";
            }
        }

        //retorna os filtros formatados
        return $sql;
    }
}
