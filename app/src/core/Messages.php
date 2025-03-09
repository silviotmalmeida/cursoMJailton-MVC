<?php

namespace src\core;

// classe de gerenciamento das mensagens
class Messages
{
    // método para publicar a mensagem
    public static function setMsg(string $msg, int $tipo = 1): void
    {
        // estabelecendo os tipos
        // 1: sucesso / -1: erro / 2: info
        if ($tipo == -1) {
            $classe = "erro";
            $icone  = "fa-exclamation-triangle";
        } else if ($tipo == 2) {
            $classe = "info";
            $icone  = "fa-exclamation-circle";
        } else {
            $classe = "sucesso";
            $icone  = "fa-check";
        }

        // organizando os dados
        $resultado = (object) array(
            "tipo" => $tipo,
            "msg"  => $msg,
            "classe" => $classe,
            "icone" => $icone
        );

        // atualizando a sessão
        $_SESSION["msg"] = $resultado;
    }

    // método para coletar a mensagem
    public static function getMsg(): object
    {
        // obtendo a mensagem, se existir
        $msg = (isset($_SESSION["msg"])) ? $_SESSION["msg"] : null;

        // limpando a session
        if ($msg) {
            self::clearMsg();
        }

        // retornando a mensagem
        return $msg;
    }

    // método para zerar a mensagem
    public static function clearMsg(): void
    {
        unset($_SESSION["msg"]);
    }

    // médoto para verificar se existe mensagem na session
    public static function existsMsg(): bool
    {
        return (isset($_SESSION["msg"])) ? true : false;
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
        $errors = (isset($_SESSION["errors"])) ? $_SESSION["errors"] : null;

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
        return (isset($_SESSION["erro"])) ? true : false;
    }


    // método para publicar os dados de formulários
    public static function setForm(array $form): void
    {
        $_SESSION["form"] = $form;
    }

    // método para coletar os dados de formulários
    public static function getForm(): array
    {
        // obtendo os dados, se existirem
        $form = (isset($_SESSION["form"])) ? $_SESSION["form"] : null;

        // limpando a session
        if ($form) {
            self::clearForm();
        }

        // retornando os dados
        return $form;
    }

    // método para zerar os dados de formulários
    public static function clearForm(): void
    {
        unset($_SESSION["form"]);
    }

    // médoto para verificar se exitem dados de formulários na session
    public static function existsForm(): bool
    {
        return (isset($_SESSION["form"])) ? true : false;
    }
}
