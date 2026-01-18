<?php

require_once __DIR__ .  "/../Helper/Database.php";
require_once "Prestataire.php";
require_once "Huissier.php";
require_once "City.php";

class Avocat extends Prestataire {

    private ?PDO $con=null;
    private int $years_of_experiences;
    private float $hourly_rate;
    private string $specialization;
    private int $consultation_online;
    private int $city_id;

    public function __construct(string $name, string $email, string $phone, int $years_of_experiences, float $hourly_rate, string $specialization, int $consultation_online, int $city_id, ?int $id = null)
    {
        parent::__construct($name, $email, $phone, $id);
        $this->con = Database::getInstance()->getConnection();
        $this->years_of_experiences = $years_of_experiences;
        $this->hourly_rate = $hourly_rate;
        $this->specialization = $specialization;
        $this->consultation_online = $consultation_online;
        $this->city_id = $city_id;
    }
    public function storeAvocat(){
        $sql = "INSERT INTO lawyer(name, email, phone, years_of_experiences, hourly_rate, specialization, consultation_online, city_id)
                VALUES(:name, :email, :phone, :years_of_experiences, :hourly_rate, :specialization, :consultation_online, :city_id)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':phone' => $this->phone,
            ':years_of_experiences' => $this->years_of_experiences,
            ':hourly_rate' => $this->hourly_rate,
            ':specialization' => $this->specialization,
            ':consultation_online' => $this->consultation_online,
            ':city_id' => $this->city_id,
        ]);
    }
    public static function getAll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT lawyer.id as id, lawyer.name, email, phone, years_of_experiences as exp, consultation_online, specialization, hourly_rate, city.name as cityname FROM lawyer
                INNER JOIN city ON lawyer.city_id = city.id";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getAlll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(id) as ttl FROM lawyer";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public static function getById(int $id){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM lawyer WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateAvocat(){
        $con = Database::getInstance()->getConnection();
        $sql = "UPDATE lawyer SET name = :name, email = :email, phone = :phone, years_of_experiences = :years_of_experiences, hourly_rate = :hourly_rate, specialization = :specialization, consultation_online = :consultation_online, 
            city_id = :city_id WHERE id = :id";
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':phone' => $this->phone,
            ':years_of_experiences' => $this->years_of_experiences,
            ':hourly_rate' => $this->hourly_rate,
            ':specialization' => $this->specialization,
            ':consultation_online' => (int)$this->consultation_online,
            ':city_id' => $this->city_id,
            ':id' => $this->id,
        ]);
    }

    public static function deleteAvocatById($id){
        $con = Database::getInstance()->getConnection();
        $sql = "DELETE from lawyer WHERE id = :id";
        $stmt =  $con->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
        ]);
    }

    public static function repartition(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(lawyer.id) as ttlav, COUNT(hussier.id) as ttlhu, city.name as cityname, (COUNT(lawyer.id) + COUNT(hussier.id)) as overall FROM city 
        LEFT JOIN hussier ON city.id = hussier.city_id
        LEFT JOIN lawyer ON city.id = lawyer.city_id
        WHERE lawyer.city_id IS NOT NULL OR hussier.city_id IS NOT NULL
        GROUP BY cityname";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function topthree(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT name, specialization, years_of_experiences FROM lawyer
        ORDER BY years_of_experiences DESC LIMIT 3";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>