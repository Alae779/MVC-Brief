<?php
require_once __DIR__ . "/../models/Avocat.php";
require_once __DIR__ . "/../models/Huissier.php";
class proController {
    
    public static function create() {
        //model $villes
        
        require './views/create.php';
    }

    public static function edit(){
        require './views/update.php';
    }

    public static function store(){
        if(isset($_POST['submit'])){
        $type = $_POST['type'] ?? '';
        echo $type;
        if($type === 'avocat'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $years_of_experiences = $_POST['years_of_experiences'];
            $hourly_rate = $_POST['hourly_rate'];
            $specialization = $_POST['specialization'];
            $consultation_online = (int)$_POST['consultation_online'];

            $avocat = new Avocat($name, $email, $phone, $years_of_experiences, $hourly_rate, $specialization, $consultation_online, $city_id);
            $avocat->storeAvocat();

        }
        elseif($type === 'huissier'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $years_of_experiences = $_POST['years_of_experiences'];
            $hourly_rate = $_POST['hourly_rate'];
            $types_actes = $_POST['types_actes'];

            $huissier = new Huissier($name, $email, $phone, $years_of_experiences, $hourly_rate, $types_actes, $city_id);
            $huissier->storeHuissier();

        }
        header("location: home");
        exit;
            
        }
    }
}
?>