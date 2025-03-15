<?php

namespace src\core;

// classe para validação de dados
class Validation
{

    // atributos
    private array $attributes;
    private array $items;
    private array $errors;

    // Constantes com numeração de erros;
    const ERROR_EMPTY  = 1;
    const ERROR_NUMBER = 2;
    const ERROR_MAXLENGHT = 3;
    const ERROR_MINLENGHT = 4;
    const ERROR_DATE   = 5;
    const ERROR_EMAIL  = 6;
    const ERROR_CPF    = 7;
    const ERROR_CNPJ   = 8;
    const ERROR_UNICO  = 9;

    // construtor
    public function __construct()
    {
        $this->attributes = array();
        $this->items = array();
        $this->errors = array();
    }

    // método para inserção dos dados
    public function setItem(string $key, mixed $value): void
    {
        $this->attributes[$key] = $value;
        $this->items[$key] = new ValidationItem($key, $value);
    }

    // método para obtenção dos dados de uma chave
    public function getItem(string $key): ValidationItem
    {
        // se já estiver setado, retorna o item específico
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        // senão retorna um item nulo
        else {
            return new ValidationItem();
        }
    }

    // método para totalização dos erros
    public function qtdErrors(): int
    {
        $qtdErrors = 0;
        foreach ($this->items as $item) {
            $qtdErrors += $item->qtdErrors();
        }
        return $qtdErrors;
    }

    // método para coleta de todos os erros
    public function getErrors(): array
    {
        // iterando sobre os itens
        foreach ($this->items as $item) {
            // se existirem erros
            if ($item->getErrors()) {
                // iterando sobre os erros do item
                foreach ($item->getErrors() as $error) {
                    // incrementando o array de erros
                    array_push($this->errors[], $error);
                }
            }
        }
        return $this->errors;
    }

    // método para obtenção dos atributos
    public function getAtributos()
    {
        return $this->attributes;
    }
}
