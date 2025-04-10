<?php

namespace src\models\service;

use src\core\Messages;
use src\models\dao\ClienteDao;
use src\models\validation\ClienteValidation;

// service para tratamento dos dados do dao
class ClienteService
{
    // listagem
    public static function list(): array
    {
        return ClienteDao::preparedGet();
    }

    // criação
    public static function create(array $keyValuesAttributes): int|false
    {
        // inicializando o resultado
        $result = false;

        // validando os atributos
        $validation = ClienteValidation::validate($keyValuesAttributes);

        // se não existirem erros na validação
        if ($validation->qtdErrors() === 0) {

            // instanciando o  dao
            $dao = new ClienteDao($keyValuesAttributes);

            // criando
            $result = $dao->insert(["id_cliente"]);
            // se a criação foi bem-sucedida, registra nensagem de sucesso
            if ($result !== false) {
                Messages::setMessage("Registro criado  com sucesso!", 1);
            }
            // senão, registra nensagem de erro
            else {
                Messages::setMessage("Não foi possível criar o registro.", -1);
            }
            // limpando o array de dados de formulário
            Messages::clearFormData();            
        }
        // se existirem erros na validação
        else {
            // limpando erros anteriores
            Messages::clearErrors();
            // setando os erros
            Messages::setErrors($validation->getErrors());
        }

        return $result;
    }
}
