<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier un employé</title>
    <link rel="stylesheet" type="text/css" href="assets/css/modify.css">
</head>
<body>
<?php 
    include_once "classes/EmployeeManager.php";
    include_once "classes/Employee.php";

    $employeeManager = new EmployeeManager();

    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $employee = $employeeManager->getEmployeeById($id);

        if(isset($_POST['button']))
        {
            extract($_POST);
      
            

            $errors = [];
            if (!Validation::validateNom($nom)) {
                $errors['nom'] = "Le nom ne peut pas être vide";
            }

            if (!Validation::validatePrenom($prenom)) {
                $errors['prenom'] = "Le prénom ne peut pas être vide";
            }

            if (!Validation::validateAge($age)) {
                $errors['age'] = "L'âge doit être un nombre supérieur à 1";
            }

            if (!Validation::validateEmail($email)) {
                $errors['email'] = "L'adresse e-mail n'est pas valide";
            }

            if (count($errors) === 0) {
                // Aucune erreur, mettre à jour l'employé
                $result = $employeeManager->updateEmployee($id, $nom, $prenom, $age, $email);

                if ($result) {
                    header("Location: index.php");
                    exit;
                } else {
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
        <span class="error_message">
            <?php
            if (isset($errors['nom'])) {
                echo $errors['nom'];
            }
            ?>
        </span>
        
        <label>Prénom</label>
        <input type="text" name="prenom" value="<?= $employee->getPrenom() ?>">
        <span class="error_message">
            <?php
            if (isset($errors['prenom'])) {
                echo $errors['prenom'];
            }
            ?>
        </span>
        
        <label>Âge</label>
        <input type="number" name="age" value="<?= $employee->getAge() ?>">
        <span class="error_message">
            <?php
            if (isset($errors['age'])) {
                echo $errors['age'];
            }
            ?>
        </span>
        
        <label>Email</label>
        <input type="text" name="email" value="<?= $employee->getEmail() ?>">
        <span class="error_message">
            <?php
            if (isset($errors['email'])) {
                echo $errors['email'];
            }
            ?>
        </span>
        
        <input type="submit" value="Modifier" name="button">
    </form>
</div>
</body>
</html>
