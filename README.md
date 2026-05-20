# DigitalSignage
This is a digital signage brazilian project. The plataform can register players (made with raspberryPi) and play selected playlist of images and videos

# Routes Protocol

The routing system is managed by the Route class, which provides methods to define and manipulate application routes.

The core of this module is the dispatch() method. This method acts as the central request handler: it listens for incoming HTTP requests, extracts the requested path, and checks whether it matches any route registered in the routing table.

If a matching route is found, the system redirects execution to the corresponding controller and method.
If no match is found, an error handler is triggered (typically resulting in a 404 Not Found response).

This design centralizes request handling and ensures consistent routing behavior across the application.

so:
- 1st:
    Create a new var router from Router class and create a class controller to reference this entity (NavigationController for exemple, to controll all routes for all users)
  
  1- ```$router = new Router();```
  
  2-
  ```
  class NavgationAdmController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function dashboard(){
        
        $caminho = __DIR__ . "/../views/dashboard/dashboard.php";
        $menu = __DIR__ . "/../views/components/menu.php";
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        
        include $caminho;
    }```

- 2nd:
    Register the path using some method (GET or POST ) from Router using the next syntax:
  ```$router->get("/NewRoutePath",[NameClassController::class,"nameMethodInsidController"]); ```

- 3rt:
    Run the dispatch:

   ```$router->dispach();```

remember to import the Router class and all Controllers
  
# Database settings
Every updating made in database need to be add in ```setupdatabase.php``` , for exemple, to create a new table, the sql code needs to stay in the archive
