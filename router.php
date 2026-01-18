<?php
class Router{

    public static $routes = [
    "" => ["homeController", "index"],
    "home" => ["homeController", "index"],
    "create" => ["proController", "create"],
    "store" => ["proController", "store"],

    "avocat/edit" => ["avocatController", "edit"],
    "avocat/update" => ["avocatController", "update"],
    "huissier/edit" => ["huissierController", "edit"],
    "huissier/update" => ["huissierController", "update"],

    "avocat/delete" => ["avocatController", "delete"],
    "huissier/delete" => ["huissierController", "delete"],
    ];

    public static function dispatch(){

        $page = $_GET['page'] ?? "home";

        if(array_key_exists($page, self::$routes)){
            $controller = self::$routes[$page][0];
            $method = self::$routes[$page][1];

            require "./controllers/".$controller.".php";
            $controller::$method();
        }else{
            echo "page error 404";
        }
    }
}

?>