<?php

namespace src\core;

// classe de gerenciamento das mensagens
class Messages
{
    // método para publicar a mensagem
    public static function setMessage(string $message, int $type = 1): void
    {
        // estabelecendo os tipos
        // 1: sucesso / -1: erro / 2: info
        if ($type == -1) {
            $class = "error";
            $icon  = "fa-exclamation-triangle";
        } else if ($type == 2) {
            $class = "info";
            $icon  = "fa-exclamation-circle";
        } else {
            $class = "success";
            $icon  = "fa-check";
        }

        // organizando os dados
        $resultado = (object) array(
            "type" => $type,
            "message"  => $message,
            "class" => $class,
            "icon" => $icon
        );

        // atualizando a sessão
        $_SESSION["message"] = $resultado;
    }

    // método para coletar a mensagem
    public static function getMessage(): object|null
    {
        // obtendo a mensagem, se existir
        $message = self::existsMessage() ? $_SESSION["message"] : null;

        // limpando a session
        if ($message) {
            self::clearMessage();
        }

        // retornando a mensagem
        return $message;
    }

    // método para zerar a mensagem
    public static function clearMessage(): void
    {
        unset($_SESSION["message"]);
    }

    // médoto para verificar se existe mensagem na session
    public static function existsMessage(): bool
    {
        return (isset($_SESSION["message"])) ? true : false;
    }

    // método para publicar os erros
    public static function setErrors(array $errors): void
    {
        // atualizando a sessão
        $_SESSION["errors"] = $errors;
    }

    // método para coletar os erros
    public static function getErrors(): array
    {
        // obtendo os erros, se existirem
        $errors = self::existsErrors() ? $_SESSION["errors"] : null;

        // limpando a session
        if ($errors) {
            self::clearErrors();
        }

        // retornando os erros
        return $errors;
    }

    // método para zerar os erros
    public static function clearErrors(): void
    {
        unset($_SESSION["errors"]);
    }

    // médoto para verificar se exitem erros na session
    public static function existsErrors(): bool
    {
        return (isset($_SESSION["errors"])) ? true : false;
    }

    // recurso utilizado para preservar os dados de formulários durante o processo de validação
    // evitando a necessidade de o usuário inserir os dados novamente após erros de validação
    // 
    // método para salvar os dados de formulário
    public static function setFormData(array|object $form): void
    {
        $_SESSION["formData"] = $form;
    }

    // método para coletar os dados de formulários
    public static function getFormData(): array|object
    {
        // obtendo os dados, se existirem
        $formData = self::existsFormData() ? $_SESSION["formData"] : null;

        // limpando a session
        if ($formData) {
            self::clearFormData();
        }

        // retornando os dados
        return $formData;
    }

    // método para zerar os dados de formulários
    public static function clearFormData(): void
    {
        unset($_SESSION["formData"]);
    }

    // médoto para verificar se exitem dados de formulários na session
    public static function existsFormData(): bool
    {
        return (isset($_SESSION["formData"])) ? true : false;
    }
}
