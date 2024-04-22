<?php

$id1 = $_GET['id1'];
$id2 = $_GET['id2'];

$bdd = new PDO("mysql:host=localhost;dbname=sga", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requette = $bdd->query("UPDATE `taches` SET `status`= 1 WHERE id_tache = $id1");
$header = "location:simplePage.php?id=".$id2."";
header($header);



?>