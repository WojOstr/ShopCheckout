<?php
// Klasa połączenia z bazą danych, zmienić dane jeśli potrzebne
class database {
    public $db_connection = false;
    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $name = "shopcashout";
    public function __construct() {
        $this->db_connection = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if(mysqli_connect_error()) {
            echo "??";
        }
        else{
            return $this->db_connection;
        }
    }
}

