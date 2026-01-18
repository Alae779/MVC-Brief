<?php

require_once __DIR__ . "/../Helper/Database.php";
require_once "Prestataire.php";

class Huissier extends Prestataire {

    private ?PDO $con=null;
    private int $years_of_experiences;
    private float $hourly_rate;
    private string $type;
    private int $city_id;

    public function __construct(string $name, string $email, string $phone, int $years_of_experiences, float $hourly_rate, string $type, $city_id, ?int $id = null)
    {
        parent::__construct($name, $email, $phone, $id);
        $this->con = Database::getInstance()->getConnection();
        $this->years_of_experiences = $years_of_experiences;
        $this->hourly_rate = $hourly_rate;
        $this->type = $type;
        $this->city_id = $city_id;
    }

    public function storeHuissier(){
        $sql = "INSERT INTO hussier(name, email, phone, years_of_experiences, hourly_rate, type, city_id)
                VALUES(:name, :email, :phone, :years_of_experiences, :hourly_rate, :type, :city_id)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':phone' => $this->phone,
            ':years_of_experiences' => $this->years_of_experiences,
            ':hourly_rate' => $this->hourly_rate,
            ':type' => $this->type,
            ':city_id' => $this->city_id,
        ]);
    }

    public static function getAll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT hussier.id as id, hussier.name, email, phone, years_of_experiences as exp, hourly_rate, type, city.name as cityname FROM hussier
                INNER JOIN city ON hussier.city_id = city.id";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getAlll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(id) as ttl FROM hussier";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public static function getById(int $id){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM hussier WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateHuissier(){
        $con = Database::getInstance()->getConnection();
        $sql = "UPDATE hussier SET name = :name, email = :email, phone = :phone, years_of_experiences = :years_of_experiences, hourly_rate = :hourly_rate, type = :type, 
            city_id = :city_id WHERE id = :id";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':phone' => $this->phone,
            ':years_of_experiences' => $this->years_of_experiences,
            ':hourly_rate' => $this->hourly_rate,
            ':type' => $this->type,
            ':city_id' => $this->city_id,
            ':id' => $this->id,
        ]);
        return $result;
    }

    public static function deleteHuissierById($id){
        $con = Database::getInstance()->getConnection();
        $sql = "DELETE from hussier WHERE id = :id";
        $stmt =  $con->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
        ]);
    }
}

?>