<?php

namespace src\models\service;

use src\core\Messages;

// service para tratamento dos dados do dao
abstract class Service
{
    //definição dos atributos a serem detalhados nas classes filhas
    protected static string $dao = '';
    protected static string $primaryKey = '';
    protected static string $validationClass = '';

    // listagem
    public static function list(): array
    {
        return (static::$dao)::preparedGet();
    }

    // consulta por id
    public static function getOne(string $id): array
    {
        return (static::$dao)::preparedGet(filters: [((static::$dao)::getPrimaryKey()) => $id], limit: 1);
    }

    // criação e atualização
    public static function save(array $keyValuesAttributes): string|bool
    {
        // inicializando o resultado
        $result = false;

        // validando os atributos
        $validation = (static::$validationClass)::validate($keyValuesAttributes);

        // se não existirem erros na validação
        if ($validation->qtdErrors() === 0) {

            // instanciando o  dao
            $dao = new (static::$dao)($keyValuesAttributes);

            // obtendo o nome da chave primária
            $primaryKey = ((static::$dao)::getPrimaryKey());

            // se o id não estiver definido, trata-se de criação
            if ($dao->$primaryKey === '' or $dao->$primaryKey === null) {

                // criando
                $result = $dao->preparedInsert([$primaryKey]);
                // se a criação foi bem-sucedida, registra nensagem de sucesso
                if ($result !== false) {
                    Messages::setMessage("Registro criado com sucesso!", 1);
                    // limpando o array de dados de formulário
                    Messages::clearFormData();
                }
                // senão, registra nensagem de erro
                else {
                    Messages::setMessage("Não foi possível criar o registro.", -1);
                }
            }
            // senão, trata-se de atualização
            else {

                // atualizando
                $result = $dao->preparedUpdate($primaryKey);
                // se a atualização foi bem-sucedida, registra nensagem de sucesso
                if ($result > 0) {
                    Messages::setMessage("Registro atualizado com sucesso!", 1);
                    // limpando o array de dados de formulário
                    Messages::clearFormData();
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

    // exclusão
    public static function delete(string $id): void
    {
        // obtendo o registro do BD
        $clienteBD = static::getOne($id);
        // se o registro existir,
        if ($clienteBD != []) {
            // exclui
            $result = $clienteBD[0]->preparedDelete('id_cliente');

            // se a exclusão foi bem sucedida, envia mensagem
            if($result > 0){
                Messages::setMessage("Registro excluído com sucesso!", 1);
            }
            // senão, envia mensagem
            else{
                Messages::setMessage("Não foi possível excluir o registro.", -1);
            }
        }
        // senão, envia mensagem
        else {
            Messages::setMessage("Não foi possível excluir o registro.", -1);
        }
    }
}
