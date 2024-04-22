<?php

session_start();

$id = $_GET['id'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("SELECT `id_user`, `nom_et_prenom`, `mot_de_passe`, `age`, `sexe`, `status_user` FROM `utilisateur` WHERE id_user = $id");

while ($a = $requette->fetch()) {
    $nom = $a['nom_et_prenom'];
}

// la fonction d'affichage


if ($_SESSION['nom'] !== "a") {
    header('location:index.php');
    exit();
}

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("SELECT `id_tache`, `id_user`, `description`, `status`, `date_et_heure_asssignation` FROM `taches` WHERE id_user = $id ORDER BY id_tache DESC;");


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
        <h3 style="color: red; margin-left : 20%">Taches de <?=$nom ?></h3>
    </div>

        <center style="margin-top: 3%;">
            <div class="col-md-10 col-xs-10 col-ls-10 col-lg-10">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Description</th>
                            <th>Date et heure Assigantion</th>
                            <th>Statu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            while ($a = $requette->fetch()) {
                                if ($a['status'] == "0") {
                                    echo "
                                        <tr align='center'>
                                            <td>".$a['id_tache']."</td>
                                            <td>".$a['description']."</td>
                                            <td>".$a['date_et_heure_asssignation']."</td>
                                            <td><a href='updateTask.php?id1=".$a['id_tache']."&id2=".$a['id_user']."' class='btn btn-primary'>Effectuer</a></td>
                                        </tr>
                                    ";
                                }
                                else {
                                    echo "
                                        <tr align='center'>
                                            <td>".$a['id_tache']."</td>
                                            <td>".$a['description']."</td>
                                            <td>".$a['date_et_heure_asssignation']."</td>
                                            <td style='color : blue;'>Effectuee</td>
                                        </tr>
                                    ";
                                }
                            }
                        
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </center>
</body>
</html>