<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des employés</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <a href="add.php" class="Btn_add"> <img src="assets/img/plus.png" > Ajouter</a>
        <table>
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            include_once "classes/EmployeeManager.php";
            $employeeManager = new EmployeeManager();
            $employees = $employeeManager->getAllEmployees();
            if (empty($employees)) {
                echo "Il n'y a pas encore d'employé ajouté !";
            } else {
                foreach ($employees as $employee) {
                    ?>
                    <tr>
                        <td><?= $employee->getNom() ?></td>
                        <td><?= $employee->getPrenom() ?></td>
                        <td><?= $employee->getAge() ?></td>
                        <td><?= $employee->getEmail() ?></td>
                        <td><a href="modify.php?id=<?= $employee->getId() ?>"><img src="assets/img/pen.png"></a></td>
                        <td><a href="delete.php?id=<?= $employee->getId() ?>"><img src="assets/img/trash.png"></a></td>
                    </tr>
                    <?php
                }
            }
            ?>     
        </table>
    </div>
</body>
</html>
