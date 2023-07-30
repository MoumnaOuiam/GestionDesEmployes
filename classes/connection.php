<?php
class connection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "entreprise";
    private $con;

    public function __construct() {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->con->connect_error) {
            die("Échec de la connexion à la base de données : " . $this->con->connect_error);
        }
    }

    public function getConnection() {
        return $this->con;
    }
}
?>