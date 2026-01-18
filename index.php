<?php
require_once 'router.php';

Router::$routes = [

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

    "dashboard" => ["dashboardController", "dash"],
  
];
Router::dispatch();

?>