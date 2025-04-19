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

    // consulta por id
    public static function getOne(string $id): array
    {
        return ClienteDao::preparedGet(filters: ['id_cliente' => $id], limit: 1);
    }

    // criação e atualização
    public static function save(array $keyValuesAttributes): string|bool
    {
        // inicializando o resultado
        $result = false;

        // validando os atributos
        $validation = ClienteValidation::validate($keyValuesAttributes);

        // se não existirem erros na validação
        if ($validation->qtdErrors() === 0) {

            // instanciando o  dao
            $dao = new ClienteDao($keyValuesAttributes);

            // se o id não estiver definido, trata-se de criação
            if ($dao->id_cliente === '' or $dao->id_cliente === null) {

                // criando
                $result = $dao->insert(["id_cliente"]);
                // se a criação foi bem-sucedida, registra nensagem de sucesso
                if ($result !== false) {
                    Messages::setMessage("Registro criado com sucesso!", 1);
                    // limpando o array de dados de formulário
                    // Messages::clearFormData();
                }
                // senão, registra nensagem de erro
                else {
                    Messages::setMessage("Não foi possível criar o registro.", -1);
                }
            }
            // senão, trata-se de atualização
            else {

                // atualizando
                $result = $dao->update('id_cliente');
                // se a atualização foi bem-sucedida, registra nensagem de sucesso
                if ($result !== false) {
                    Messages::setMessage("Registro atualizado com sucesso!", 1);
                    // limpando o array de dados de formulário
                    // Messages::clearFormData();
                }
                // senão, registra nensagem de erro
                else {
                    Messages::setMessage("Não foi possível atualizar o registro.", -1);
                }
            }
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
