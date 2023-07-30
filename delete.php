<?php
include_once "classes/EmployeeManager.php";
$employeeManager = new EmployeeManager();

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    echo "<script>
        var confirmed = confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');
        if (confirmed) {
            window.location.href = 'delete_confirm.php?id=$employee_id';
        } else {
            window.location.href = 'index.php';
        }
    </script>";
    exit;
} else {
    header("Location:index.php");
    exit;
}
?>

