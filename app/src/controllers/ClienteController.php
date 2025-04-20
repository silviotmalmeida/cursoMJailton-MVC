<?php

namespace src\controllers;

use src\core\Controller;
use src\core\Messages;
use src\helper\Helper;
use src\models\service\ClienteService;

class ClienteController extends Controller
{

    public function index(): void
    {
        $data["clientes"] = ClienteService::list();
        $data["view"]  = "Cliente/Index";
        $this->loadView("template", $data);
    }

    public function create(): void
    {
        $data["cliente"] = Messages::getFormData();
        $data["view"]  = "Cliente/Create";
        $this->loadView("template", $data);
    }

    public function update(string $id): void
    {
        // obtendo o registro do BD
        $clienteBD = ClienteService::getOne($id);
        // se o registro existir, redirecionando para o create
        if ($clienteBD != []) {
            $data["cliente"] = Helper::objectToArray($clienteBD[0]);
            $data["view"]  = "Cliente/Create";
            $this->loadView("template", $data);
        }
        // senão,
        else {
            // redirecionando para o index
            $this->redirect(BASE_URL . "cliente/index");
        }
    }

    public function save(): void
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
            'cpf' => $_POST['cpf'],
            'sexo' => $_POST['sexo'],
            'data_nascimento' => $_POST['data_nascimento'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'observacao' => $_POST['observacao'],
            'data_cadastro' => date("Y-m-d"),
        ];

        // preservando os dados do formulário para uso posterior, caso necessário
        Messages::setFormData($keyValueAttributes);

        // salvando
        if (ClienteService::save($keyValueAttributes) !== false) {
            // redirecionando para o index
            $this->redirect(BASE_URL . "cliente/index");
        }
        // em caso de erro,
        else {
            // redirecionando para o create
            $this->redirect(BASE_URL . "cliente/create");
        }
    }

    public function delete(string $id): void
    {
        // excluindo
        ClienteService::delete($id);
        // redirecionando para o index
        $this->redirect(BASE_URL . "cliente/index");
    }
}
