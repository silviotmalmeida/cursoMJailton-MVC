<?php

namespace src\helper;

class Helper
{
    // function i($array){
    //     echo "<pre>";
    //     print_r($array);
    //     echo "</pre>";
    //     exit;
    // }

    // function tira_mascara($valor){
    //     return  preg_replace("/\D+/", "", $valor);
    // }

    // função auxiliar para converter um objeto em um array, caso necessário
    static function objectToArray(object|array $objeto): array
    {
        return is_array($objeto) ? $objeto : (array) $objeto;
    }

    // função auxiliar para validar email
    static function validateEmail(string $email): bool
    {
        // separando os campos
        $user = "/[a-zA-Z0-9\._-]+@";
        $domain = "[a-zA-Z0-9\._-]+.";
        $extension = "([a-zA-Z]{2,4})$/";
        $pattern = $user . $domain . $extension;
        if (preg_match($pattern, $email))
            return true;
        else
            return false;
    }

    // função auxiliar para validar CPF
    static function validateCPF(string $cpf): bool
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    // função auxiliar para validar CNPJ
    static function validateCNPJ(string $cnpj): bool
    {
        // Extrai somente os números
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cnpj) != 14)
            return false;
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 11.111.111/1111-11
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }


    //  ///
    //  function upload($arq, $config_upload){
    //      set_time_limit(0);
    //      $nome_arquivo 		 = $_FILES[$arq]["name"];
    //      $tamanho_arquivo 	 = $_FILES[$arq]["size"];
    //      $arquivo_temporario = $_FILES[$arq]["tmp_name"];
    //      $erro               = 0;
    //      $msg                = "";
    //      $retorno            = array();
    //      if(!empty($nome_arquivo)){
    //          $ext        = strrchr($nome_arquivo, ".");
    //          $nome_final = ($config_upload["renomeia"]) ? md5(time()) . $ext:  $nome_arquivo;
    //          $caminho    = $config_upload["caminho_absoluto"] .$nome_final;


    //          if (($config_upload["verifica_tamanho"]) && ($tamanho_arquivo > $config_upload["tamanho"])){
    //              $msg ="O arquivo é maior que o permitido" ;
    //              $erro = -1;
    //          }

    //          if(($config_upload["verifica_extensao"]) && (!in_array($ext,$config_upload["extensoes"]))){
    //              $msg ="O arquivo não é permitido para upload";
    //              $erro = -1;
    //          }

    //          if($erro !=-1){
    //              if(move_uploaded_file($arquivo_temporario, $caminho)){
    //                  $msg    =  "Arquivo enviado com sucesso";
    //                  $erro   =  0;
    //              }else{
    //                  $msg    = "erro ao fazer o upload";
    //                  $erro   = -1;
    //              }
    //          }

    //      }else{
    //          $msg = "Arquivo vazio";
    //          $erro = -1;
    //      }
    //      $retorno = (object) array("erro" => $erro, "msg"=> $msg, "nome"=>$nome_final);
    //      return $retorno;
    //  }
}
