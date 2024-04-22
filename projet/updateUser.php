<?php

session_start();

$id = $_GET['id'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("SELECT `id_user`, `nom_et_prenom`, `mot_de_passe`, `age`, `sexe`, `status_user` FROM `utilisateur` WHERE id_user = $id");
while ($a = $requette->fetch()) {
    $nom = $a['nom_et_prenom'];
}

// if ($_SESSION['lien1'] !== "ok") {
//     header('location:adminPage.php');
//     exit();
// }

if (isset($_POST['annuler'])) {
    header('location:adminPage.php');
} else if (!empty($_POST['valider'])) {
    @$username = htmlspecialchars(strip_tags($_POST['nom']));
    @$age = htmlspecialchars(strip_tags($_POST['age']));
    @$sexe = htmlspecialchars(strip_tags($_POST['sexe']));
    @$status = htmlspecialchars(strip_tags($_POST['status']));
    @$password = htmlspecialchars(strip_tags($_POST['mdp']));

    $sql = "UPDATE `utilisateur` SET `nom_et_prenom`= :nom_et_prenom, `mot_de_passe`= :mot_de_passe,`age`= :age,`sexe`= :sexe,`status_user`= :status_user WHERE id_user = $id";

    $requette = $bdd->prepare($sql);
    $requette->bindParam(":nom_et_prenom", $username);
    $requette->bindParam(":mot_de_passe", $password);
    $requette->bindParam(":age", $age);
    $requette->bindParam(":sexe", $sexe);
    $requette->bindParam(":status_user", $status);
    $requette->execute();

    header('location:adminPage.php');
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
            let nom = document.f1.nom.value
            let age = document.f1.age.value
            let sexe = document.f1.sexe.value
            let status = document.f1.status.value
            let mdp = document.f1.mdp.value

            if (nom !== "" 
                && age !== ""
                && sexe !== ""
                && status !== ""
                && mdp !== ""
            ) {
                alert("utilisateur enregistree avec succes")
            }
        }
    </script>
</head>
<body>
    <div class="flex">
        <div><?php require("./head.php"); ?></div>
    </div>

    <center>
        <h3 style="color: red;">Modifier <?=$nom ?></h3>
        <div class="container">
            <div class="col-md-5 col-xs-5 col-ls-5 col-lg-5">
                <form method="post" class="form-group formulaire" name="f1">
                    <table>
                        <tr>
                            <td><div class="nom">Nom et Prenom</div></td>
                            <td><input type="text" name="nom" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><div class="nom">Age</div></td>
                            <td><input type="number" name="age" class="form-control" required min="1" max="100"></td>
                        </tr>
                        <tr>
                            <td><div class="nom">Sexe</div></td>
                            <td class="flex-line"><input type="radio" name="sexe" value="Masculin" required>M <input type="radio" name="sexe" value="Feminin" required>F</td>
                        </tr>
                        <tr>
                            <td><div class="nom">Statu</div></td>
                            <td>
                                <select name="status" class="form-control" required>
                                    <option value="Stagiaire">Stagiaire</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><div class="nom">Mot de passe</div></td>
                            <td><input type="password" name="mdp" class="form-control" required></td>
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