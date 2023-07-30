<?php 
include_once("classes/EmployeeManager.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un employé</title>
    <link rel="stylesheet" type="text/css" href="assets/css/add.css">
    
    <style>
        .message {
            margin-top: 10px;
            padding: 10px;
            display: none;
            margin-left:450px ;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="assets/img/arrow.png">Retour</a>
        <h2>Ajouter un employé</h2>
        
        <form method="post" action="add.php"  onsubmit="return validateForm();">
            <label>Nom</label>
            <input type="text" name="nom" >
            

            <label>Prénom</label>
            <input type="text" name="prenom" >
            

            <label>Âge</label>
            <input type="text" name="age">
           

            <label>Email</label>
            <input type="text" name="email">
            <span class="error_message" id="error_message"></span>
           

            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>

    <?php
     $message = '';
     $messageClass = '';
    if (isset($_POST['button'])) {
        // Le formulaire a été soumis
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        $employeeManager = new EmployeeManager();
        $result = $employeeManager->addEmployee($nom, $prenom, $age, $email);

        if ($result) {
            $message = "L'employé a été ajouté avec succès à la base de données !";
            $messageClass = "success";
        } else {
            $message = "Une erreur est survenue lors de l'ajout de l'employé : " . $employeeManager->getErrorMessage();
            $messageClass = "error";
        }
    }
    ?>

<div class="message <?php echo $messageClass; ?>">
        <?php echo $message; ?>
    </div>


  <script>
        function validateForm() {
            var errors = [];
            var errorMessage = document.getElementById('error_message'); 

            // Validation du nom
            var nom = document.getElementsByName('nom')[0].value.trim();
            if (nom === '') {
                errors.push("Le nom ne peut pas être vide");
            }

            // Validation du prénom
            var prenom = document.getElementsByName('prenom')[0].value.trim();
            if (prenom === '') {
                errors.push("Le prénom ne peut pas être vide");
            }

            // Validation de l'âge 
            var age = parseInt(document.getElementsByName('age')[0].value);
            if (isNaN(age) || age <= 1) {
                errors.push("L'âge doit être un nombre supérieur à 1");
            }

            // Validation de l'e-mail
            var email = document.getElementsByName('email')[0].value.trim();
            var mailformat = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!email.match(mailformat)) {
                errors.push("L'adresse e-mail n'est pas valide");
            }

            if (errors.length > 0) {
                errorMessage.style.display = 'block'; // Afficher le div d'erreurs
                errorMessage.innerHTML = '<ul>';
                for (var i = 0; i < errors.length; i++) {
                    errorMessage.innerHTML += '<li>' + errors[i] + '</li>';
                }
                errorMessage.innerHTML += '</ul>';
                return false;
            } else {
                errorMessage.style.display = 'none'; // Masquer le div d'erreurs s'il n'y en a pas
                return true;
            }
        }

        // Afficher le message s'il y a un message à afficher
        var messageDiv = document.querySelector('.message');
        if (messageDiv.innerHTML.trim() !== '') {
            messageDiv.style.display = 'block';
        }
    </script>
</div>

</body>
</html> 