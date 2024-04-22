<?php

$id = $_GET['id'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("DELETE FROM `utilisateur` WHERE id_user = \"$id\"");

header('location:adminPage.php');



?>