<?php
include_once "classes/Employee.php";
include_once "classes/Connection.php";

class EmployeeManager {
    private $connection;
    private $errorMessage;

    public function __construct() {
        $this->connection = new Connection();
        $this->errorMessage = null;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getAllEmployees() {
        $con = $this->connection->getConnection();
        $employees = array();

        $req = mysqli_query($con, "SELECT * FROM employe");
        while ($row = mysqli_fetch_assoc($req)) {
            $employee = new Employee($row['id'], $row['nom'], $row['prenom'], $row['age'], $row['email']);
            array_push($employees, $employee);
        }

        return $employees;
    }

    public function addEmployee($nom, $prenom, $age, $email) {
        $con = $this->connection->getConnection();
        $req = mysqli_query($con, "INSERT INTO employe VALUES (NULL ,'$nom', '$prenom', '$age', '$email')");

        if ($req) {
            return true;
        } else {
            $this->errorMessage = mysqli_error($con);
            return false;
        }
    }

    public function deleteEmployee($id) {
        $con = $this->connection->getConnection();
        $req = mysqli_query($con, "DELETE FROM employe WHERE id=$id");

        if ($req) {
            return true;
        } else {
            $this->errorMessage = mysqli_error($con);
            return false;
        }
    }

    public function getEmployeeById($id) {
        $con = $this->connection->getConnection();
        $req = mysqli_query($con, "SELECT * FROM employe WHERE id=$id");
        $row = mysqli_fetch_assoc($req);

        return new Employee($row['id'], $row['nom'], $row['prenom'], $row['age'], $row['email'] );
    }

    public function updateEmployee($id, $nom, $prenom, $age, $email) 
    {
        $con = $this->connection->getConnection();
        $req = mysqli_query($con, "UPDATE employe SET nom='$nom', prenom='$prenom', age='$age', email='$email' WHERE id=$id");

        if ($req) {
            return true;
        } else {
            $this->errorMessage = mysqli_error($con);
            return false;
        }
    }

    
}
class Validation
{
    public static function validateNom($nom)
    {
        return !empty($nom);
    }

    public static function validatePrenom($prenom)
    {
        return !empty($prenom);
    }

    public static function validateAge($age)
    {
        return is_numeric($age) && $age > 1;
    }

    public static function validateEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
?>
