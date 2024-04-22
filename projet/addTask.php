<?php

session_start();

$id = $_GET['id'];
@$id2 = $_GET['id2'];
$stat = $_GET['stat'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



// if ($_SESSION['lien1'] !== "ok") {
//     header('location:adminPage.php');
//     exit();
// }

if (isset($_POST['annuler'])) {
    header('location:adminPage.php');
} else if (!empty($_POST['valider'])) {

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s');

    @$task = htmlspecialchars(strip_tags($_POST['task']));

    $sql = "INSERT INTO `taches`(`id_user`, `description`, `date_et_heure_asssignation`) VALUES 
    (:id_user, :description_task, :date_et_heure_asssignation)";

    $requette = $bdd->prepare($sql);
    $requette->bindParam(":id_user", $id);
    $requette->bindParam(":description_task", $task);
    $requette->bindParam(":date_et_heure_asssignation", $date);
    $requette->execute();

    if ($stat == "simple") {
        header('location:adminPage.php');
    } else {
        $header = "location:adminPage2.php?id=$id2";
        header($header);
    }
    

} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script>
        function Done() {
            let task = document.f1.task.value

            if (task !== ""
            ) {
                alert("Tache enregistree avec succes")
            }
        }
    </script>
</head>
<body>
    <div class="flex">
        <div><?php require("./head.php"); ?></div>
    </div>

    <center>
        <h3 style="color: red;">Ajout de Tache</h3>
        <div class="container">
            <div class="col-md-5 col-xs-5 col-ls-5 col-lg-5">
                <form method="post" class="form-group formulaire" name="f1">
                    <table>
                        <tr>
                            <td><div class="nom">Description de la Tache</div></td>
                            <td>
                                <textarea name="task" class="form-control" cols="30" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <input type="reset" value="Annuler" name="annuler" class="btn btn-danger">
                            </td>
                            <td align="right">
                                <input type="submit" value="Soumettre" name="valider" class="btn btn-primary" onclick="Done()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </center>
</body>
</html>