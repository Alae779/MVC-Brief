<?php

require_once __DIR__ . '/../models/Avocat.php';
require_once __DIR__ . '/../models/City.php';

class avocatController{
    public static function edit() {
        $id = $_GET['id'];
        $avocat = Avocat::getById($id);
        $cities = City::getAll();

         require './views/avocatedit.php';
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
            $specialization = $_POST['specialization'];
            $consultation_online = (int)$_POST['consultation_online'];

            $avocat = new Avocat($name, $email, $phone, $years_of_experiences, $hourly_rate, $specialization, $consultation_online, $city_id, $id);
            $avocat->updateAvocat();

            header("location: /istishara/");

        }
    }

    public static function delete(){
            $id = $_GET['id'];
            Avocat::deleteAvocatById($id);
            header("location: /istishara/");
        }
}

?>