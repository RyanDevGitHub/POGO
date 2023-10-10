<?php
session_start();
include('../database/db.php');
$pdoStat = $pdo->prepare("DELETE FROM favorites
WHERE id_producte = :id_product AND id_user = :id_user");
$pdoStat->bindParam(":id_user", $_SESSION["id"]);
$pdoStat->bindParam(":id_product", $_POST["id_product"]);

if ($pdoStat->execute() === true) {
    print("sucess");
}
