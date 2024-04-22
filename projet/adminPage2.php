<?php

session_start();

$id2 = $_GET['id'];

// la fonction d'affichage


if ($_SESSION['nom'] !== "a") {
    header('location:index.php');
    exit();
}

// if (isset($_POST['lien1'])) {
//     $_SESSION['lien1'] = "ok";
//     header('location:addUser.php');
// }

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("SELECT `id_user`, `nom_et_prenom`, `mot_de_passe`, `age`, `sexe`, `status_user` FROM `utilisateur` WHERE status_user != 'Administrateur' ");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="flex">
        <div><?php require("./head.php"); ?></div>
        <div style="margin-left: 50%;"><?= "<a href='watchTask.php?id=".$id2."' class='btn btn-primary'>Voir les taches</a>" ?></div>
    </div>

        <center>
            <div class="col-md-10 col-xs-10 col-ls-10 col-lg-10">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Nom et Prenom</th>
                            <th>Age</th>
                            <th>Sexe</th>
                            <th>Statu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            while ($a = $requette->fetch()) {
                                echo "
                                    <tr align='center'>
                                        <td>".$a['id_user']."</td>
                                        <td>".$a['nom_et_prenom']."</td>
                                        <td>".$a['age']."</td>
                                        <td>".$a['sexe']."</td>
                                        <td>".$a['status_user']."</td>
                                        <td>
                                            <a href='addTask.php?id=".$a['id_user']."&stat=admin&id2=".$id2."' class='btn btn-primary'>Ajouter une tache</a> 
                                            <a href='watchTask.php?id=".$a['id_user']."' class='btn btn-primary'>Voir les taches</a>
                                        </td>
                                    </tr>
                                ";
                            }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </center>
</body>
</html>