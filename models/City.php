<?php

require_once __DIR__ . "/../Helper/Database.php";

class City{

    private ?PDO $con=null;
    private int $name;

    public function __construct(string $name, ?int $id = null)
    {
        $this->con = Database::getInstance()->getConnection();
        $this->name = $name;
    }

    public static function getAll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM city";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function getAlll(){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(city.id) AS ttl
        FROM city
        LEFT JOIN lawyer  ON city.id = lawyer.city_id
        LEFT JOIN hussier ON city.id = hussier.city_id
        WHERE lawyer.id IS NOT NULL OR hussier.id IS NOT NULL;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public static function getById(int $id){
        $con = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM city WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>