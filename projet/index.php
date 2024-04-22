<?php 
session_start();

@$username = htmlspecialchars(strip_tags($_POST['nom'])); 
@$password = htmlspecialchars(strip_tags($_POST['mdp'])); 
@$valider = $_POST['valider'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$_SESSION['nom'] = "b";

if (isset($valider)) {
    $_SESSION['nom'] = "a";
    $requette = $bdd->query("SELECT `id_user`, `nom_et_prenom`, `mot_de_passe`, `age`, `sexe`, `status_user` FROM `utilisateur` WHERE nom_et_prenom = \"$username\" && mot_de_passe = \"$password\""); 

    if ($username === "Djoukouo" && $password === "vanel") {
        header('location:adminPage.php');
    }
    else {
        while ($a = $requette->fetch()) {
            if ($a['nom_et_prenom'] == $username && $a['mot_de_passe'] == $password && $a['status_user'] != "Administrateur") {
                $_SESSION['nom'] = "a";
                $header = "location:simplePage.php?id=".$a['id_user']."";
                header($header);
                break;
            }
            else if ($a['nom_et_prenom'] == $username && $a['mot_de_passe'] == $password && $a['status_user'] == "Administrateur") {
                $_SESSION['nom'] = "a";
                $header = "location:adminPage2.php?id=".$a['id_user']."";
                header($header);
                break;
            }
            else {
                echo "erreur de login et/ou de mot de passe";
                break;
            }
        }
    }
}
// echo $username, $password;


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
    <?php require("./head.php"); ?>

    <center>
        <h3 style="color: red;">Connexion</h3>
        <div class="container">
            <div class="col-md-4 col-xs-4 col-ls-4 col-lg-4">
                <form method="post" class="form-group formulaire">
                    <table>
                        <tr>
                            <td><div class="nom">Nom et Prenom</div></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="nom" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><div class="nom">Mot de passe</div></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="mdp" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td align="center">
                                <input type="submit" value="Soumettre" name="valider" class="btn btn-primary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </center>
</body>
</html>