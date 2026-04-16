<?php
require_once(__DIR__ . "/../../config/config.php");
class Router {
//NomeDaClasse::class -> retorna o nome da classe para montar a url 
    private $routes = [];

    public function get($path, $action) {
        $this->routes["GET"][$path] = $action;
    }
    public function post($path, $action) {
        $this->routes["POST"][$path] = $action;
    }

    public function listAllRoutesGET() {
        foreach ($this->routes["GET"] as $path => $action) {
            echo "Rota: $path <br>";
            echo "Controller: " . $action[0] . "<br>";
            echo "Método: " . $action[1] . "<br><br>";
        }
    }
    public function listAllRoutesPOST() {
        foreach ($this->routes["POST"] as $path => $action) {
            echo "Rota: $path <br>";
            echo "Controller: " . $action[0] . "<br>";
            echo "Método: " . $action[1] . "<br><br>";
        }
    }
    
    public function dispach(){
        echo "passando pelo dispach";
        $type_request_method_post_get = $_SERVER["REQUEST_METHOD"];
        
        $uri = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);

        $uri = str_replace("/public", "", $uri);

        if ($uri === "") {
            $uri = "/";
            echo "pagina incicial";
        }
        if (isset($this->routes[$type_request_method_post_get][$uri])){
            
            $action = $this->routes[$type_request_method_post_get][$uri];
            $controller_class = new $action[0]();
            $method_exec =  $action[1];
            $controller_class->$method_exec();

        }else if ($uri != "/"){
            
            echo "404 - Rota não encontrada";
        }

    }
}
?>