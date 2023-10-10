<?php
include('../database/db.php');
$pdoStat = $pdo->prepare("SELECT ville_nom , ville_id FROM villes_france_free WHERE ville_code_postal = :code_postal");
$pdoStat->bindParam(":code_postal", $_POST["code-postale"]);
$pdoStat->execute();
$row = $pdoStat->fetchAll();
print(json_encode($row));
