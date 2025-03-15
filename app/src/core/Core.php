<?php

// classe do núcleo da aplicação
class Core
{
    // atributos
    private string $controller;
    private string $method;
    private array $params = array();

    // construtor
    public function __construct()
    {
        $this->getUrlData();
    }

    // método de inicialização
    public function run(): void
    {
        // obtendo o nome do controller
        $controllerName = $this->getController();

        // tratamento de exceções
        try {
            // criando o controller
            $c = new $controllerName;
            // executando o método
            call_user_func_array(array($c, $this->getMethod()), $this->getParams());
        }
        // em caso de erro, lança exception
        catch (ArgumentCountError $e) {
            throw new Exception("Erro na linha: " . $e->getLine() . " do arquivo " . $e->getFile() . " <br> O número de argumentos passado não corresponde ao esperado <br><br>");
        }
    }

    // função que obtém o controller, method e params da URL
    private function getUrlData(): void
    {
        // obtendo a url
        $url = explode("index.php", $_SERVER["PHP_SELF"]);
        $url = end($url);

        // se a URL não for vazia
        if ($url != "") {
            // divide os campos
            $url = explode('/', $url);
            // obtendo o controller
            if (isset($url[1])) $this->controller = ucfirst($url[1]) . "Controller";
            // obtendo o method
            if (isset($url[2])) {
                $this->method = $url[2];
            } else {
                $this->method = DEFAULT_METHOD;
            }
            // obtendo o params
            if (isset($url[3])) {
                $this->params = array_filter(array_slice($url, 3));
            }
        }
        // se a URL for vazia, usa valores default
        else {
            $this->controller = ucfirst(DEFAULT_CONTROLLER) . "Controller";
            $this->method = DEFAULT_METHOD;
        }
    }

    // getter do controller
    public function getController(): string
    {
        // se a classe de controller existir retorna,
        if (class_exists(NAMESPACE_CONTROLLER . $this->controller)) {
            return NAMESPACE_CONTROLLER . $this->controller;
        }
        // senão lança exceção
        else {
            throw new Exception("Página não encontrada", 404);
        }
    }

    // getter do method
    public function getMethod(): string
    {
        // se o método existir no controller, retorna-o
        if (method_exists(NAMESPACE_CONTROLLER . $this->controller, $this->method)) {
            return $this->method;
        }
        // senão lança exceção
        else {
            throw new Exception("Método não encontrado", 500);
        }
    }

    // getter do methparamsod
    public function getParams(): array
    {
        return $this->params;
    }
}
