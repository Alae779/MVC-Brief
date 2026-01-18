<?php

require_once __DIR__ . "/../Helper/Database.php";

abstract class Prestataire{

    private ?PDO $con=null;
    protected ?int $id = null;
    protected string $name;
    protected string $email;
    protected string $phone;

    public function __construct(string $name, string $email, string $phone, ?int $id = null)
    {
        $this->con = Database::getInstance()->getConnection();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    

}

?>