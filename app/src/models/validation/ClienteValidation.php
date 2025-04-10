<?php

namespace src\models\validation;

use src\core\Validation;

// classe para validação
class ClienteValidation
{
    public static function validate(array $keyValuesAttributes): Validation
    {
        // instanciando o obketo de validação
        $validation = new Validation();

        // populando o objeto de validação
        foreach ($keyValuesAttributes as $key => $value) {            
            $validation->setItem($key, $value);
        }

        // validando
        $validation->getItem('nome')->notEmpty();
        $validation->getItem('cep')->notEmpty();
        $validation->getItem('bairro')->notEmpty();
        $validation->getItem('cidade')->notEmpty();
        $validation->getItem('uf')->notEmpty();

        return $validation;
    }
}
