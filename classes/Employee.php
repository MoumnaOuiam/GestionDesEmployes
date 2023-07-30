<?php
class Employee {
    private $id;
    private $nom;
    private $prenom;
    private $age;
    private $email;

    public function __construct($id, $nom, $prenom, $age, $email) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->email = $email;

    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getAge() {
        return $this->age;
    }

    public function getEmail() {
        return $this->email;
    }
}
?>
