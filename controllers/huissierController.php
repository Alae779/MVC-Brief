<?php

require_once __DIR__ . '/../models/Huissier.php';
require_once __DIR__ . '/../models/City.php';

class huissierController{
    public static function edit() {
        $id = $_GET['id'];
        $huissier = Huissier::getById($id);
        $cities = City::getAll();

         require './views/huissieredit.php';
    }
    public static function update(){
        
        
        if(isset($_POST['submit'])){

            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $years_of_experiences = $_POST['years_of_experiences'];
            $hourly_rate = $_POST['hourly_rate'];
            $types_actes = $_POST['types_actes'];

            $huissier = new Huissier($name, $email, $phone, $years_of_experiences, $hourly_rate, $types_actes, $city_id, $id);
            $huissier->updateHuissier();

            header("location: /istishara/");

        }
    }

    public static function delete(){
        $id = $_GET['id'];
        Huissier::deleteHuissierById($id);
        header("location: /istishara/");
    }
}

?>