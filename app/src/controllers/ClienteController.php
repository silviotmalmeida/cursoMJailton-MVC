<?php

namespace src\controllers;

use src\core\Controller;
use src\core\Messages;
use src\models\service\ClienteService;

class ClienteController extends Controller
{

    public function index()
    {
        $data["clientes"] = ClienteService::list();
        $data["view"]  = "Cliente/Index";
        $this->loadView("template", $data);
    }

    public function create()
    {
        $data["cliente"] = Messages::getFormData();
        $data["view"]  = "Cliente/Create";
        $this->loadView("template", $data);
    }

    public function update($id)
    {
        $dados["view"]      = "Cliente/Create";
        $this->loadView("template", $dados);
    }

    public function save()
    {
        // obtendo os dados do POST
        $keyValueAttributes = [
            'id_cliente' => $_POST['id_cliente'],
            'nome' => $_POST['nome'],
            'cep' => $_POST['cep'],
            'endereco' => $_POST['endereco'],
            'complemento' => $_POST['complemento'],
            'numero' => $_POST['numero'],
            'bairro' => $_POST['bairro'],
            'cidade' => $_POST['cidade'],
            'uf' => $_POST['uf'],
            'celular' => $_POST['celular'],
            'sexo' => $_POST['sexo'],
            'data_nascimento' => $_POST['data_nascimento'],
            'cpf' => $_POST['cpf'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'data_cadastro' => date("Y-m-d"),
            'observacao' => $_POST['observacao'],
        ];

        // preservando os dados do formulário para uso posterior, caso necessário
        Messages::setFormData($keyValueAttributes);

        // salvando
        if (ClienteService::create($keyValueAttributes)) {
            // redirecionando para o index
            $this->redirect(BASE_URL . "cliente/index");
        }
        // em caso de erro,
        else {
            // redirecionando para o create
            $this->redirect(BASE_URL . "cliente/create");
        }
    }

    public function delete($id) {}
}
