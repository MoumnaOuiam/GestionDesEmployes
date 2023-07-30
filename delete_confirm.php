<?php
include_once "classes/EmployeeManager.php";
$employeeManager = new EmployeeManager();

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];
    $result = $employeeManager->deleteEmployee($employee_id);
    if ($result) {
        header("Location:index.php");
        exit;
    } else {
        echo "Une erreur s'est produite lors de la suppression de l'employé.";
    }
} else {
    header("Location:index.php");
    exit;
}
?>
