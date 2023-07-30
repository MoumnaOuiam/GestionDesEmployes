<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Modifier un employé</title>
    <link rel="stylesheet" type="text/css" href="assets/css/modify.css">
</head>
<body>
<?php 
    include_once "classes/EmployeeManager.php";
    $employeeManager = new EmployeeManager();

    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $employee = $employeeManager->getEmployeeById($id);

        if(isset($_POST['button']))
        {
            extract($_POST);
            if(isset($nom) && isset($prenom) && isset($age) && isset($email))
            {
                include_once "classes/EmployeeManager.php";
                $employeeManager = new EmployeeManager();
                $result = $employeeManager->updateEmployee($id, $nom, $prenom, $age, $email);
                   if($result) 
                   {
                      header("Location: index.php");
                       exit;
                   }
                   else
                   {
                       $message = "Employé non modifié : " . $employeeManager->getErrorMessage();
                   }
            }
        }   
        
            
    }
    else 
    {
        header("Location: index.php");
        exit;
    }
    

?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="assets/img/arrow.png">Retour</a>
        <h2>Modifier l'employé <?= $employee->getNom() ?></h2>
        <p class="error_message">
            <?php
            if ( isset($message) )
            {
                echo $message;
            }
            ?>
        </p>
        <form method="post">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= $employee->getNom() ?>">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= $employee->getPrenom() ?>">
            <label>Âge</label>
            <input type="number" name="age" value="<?= $employee->getAge() ?>">
            <label>Email</label>
            <input type="text" name="email" value="<?= $employee->getEmail() ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>

