<?php

namespace src\core;

use src\helper\DateTimeHelper;
use src\helper\Helper;

class ValidationItem
{
    private string $key;
    private mixed $value;
    private array $errors = [];
    private array $errorCode = [];

    // construtor
    public function __construct($key = null, $value = null)
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    // getters e setters
    public function getKey()
    {
        return $this->key;
    }
    public function setKey($key)
    {
        $this->key = $key;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }

    // método para totalização dos erros
    public function qtdErrors(): int
    {
        if ($this->errors) {
            return count($this->errors);
        }
        return 0;
    }

    // método para coleta de todos os erros
    public function getErrors(): array
    {
        return $this->errors;
    }

    // método que verifica se é vazio
    public function notEmpty(string $message = null, int $errorConstant = Validation::ERROR_EMPTY): ValidationItem
    {
        // limpando o valor
        $value = trim($this->value, " \n\t\r");
        // se o valor for vazio
        if (!strlen($value) > 0) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " não pode ficar vazio";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // método que verifica se é número
    public function isNumber(string $message = null, int $errorConstant = Validation::ERROR_NUMBER): ValidationItem
    {
        // limpando o valor
        $value = trim($this->value, " \n\t\r");
        // substituindo vígula por ponto
        $value = str_replace(",", ".", $value);
        // se o valor for não for número
        if (!is_numeric($value)) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " precisa ser um número";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se ultrapassou o tamanho máximo
    public function haveMaxLenght(int $maxLenght, string $message = null, int $errorConstant = Validation::ERROR_MAXLENGHT): ValidationItem
    {
        // se ultrapassar o tamanho máximo
        if (strlen($this->value) > $maxLenght) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " só pode ter no máximo " . $maxLenght . " caracteres";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se ultrapassou o tamanho mínimo
    public function haveMinLenght(int $minLenght, string $message = null, int $errorConstant = Validation::ERROR_MINLENGHT)
    {
        // se ultrapassar o tamanho mínimo
        if (strlen($this->value) < $minLenght) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " deve ter no mínimo " . $minLenght . " caracteres";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se é data
    // a opção 1 refere-se ao formato em inglês aaaammdd
    // a opção 2 refere-se ao formato em português ddmmaaaa
    public function isDate(int $option, string $message = null, int $errorConstant = Validation::ERROR_DATE): ValidationItem
    {
        // convertendo a string da data para array
        $dateArray = DateTimeHelper::stringDateToArray($this->value, $option);
        // se algum dos campos não for numérico ou a combinação deles não compuser uma data válida
        if (
            !is_numeric($dateArray[0]) ||
            !is_numeric($dateArray[1]) ||
            !is_numeric($dateArray[2]) ||
            !checkdate($dateArray[1], $dateArray[0], $dateArray[2])
        ) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " não é uma data válida ";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se é email
    public function isEmail(string $message = null, int $errorConstant = Validation::ERROR_EMAIL): ValidationItem
    {
        // se não for email
        if (!Helper::validateEmail($this->value)) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " precisa ser um email válido ";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se é CPF
    public function isCPF(string $message = null, int $errorConstant = Validation::ERROR_CPF): ValidationItem
    {
        // se não for cpf
        if (!Helper::validateCPF($this->value)) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " precisa ser um CPF válido ";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se é CNPJ
    public function isCNPJ(string $message = null, int $errorConstant = Validation::ERROR_CNPJ): ValidationItem
    {
        // se não for cpf
        if (!Helper::validateCNPJ($this->value)) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "O campo " . $this->key . " precisa ser um CNPJ válido ";
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }

    // verificando se é único
    public function isUnique(int $countInDB, string $message = null, int $errorConstant = Validation::ERROR_UNIQUE): ValidationItem
    {
        // se existirem registros iguais no BD
        if ($countInDB > 0) {
            // se não foi passada a mensagem, usa a padrão
            if ($message == null) {
                $message = "Já existe um registro com este " . $this->key;
            }
            // setando o erro
            $this->errors[$errorConstant] = $message;
            $this->errorCode[$errorConstant] = true;
        }
        return $this;
    }
}
