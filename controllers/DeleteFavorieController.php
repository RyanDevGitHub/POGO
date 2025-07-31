<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("DELETE FROM favorites
WHERE id_producte = :id_product AND id_user = :id_user");
$pdoStat->bindParam(":id_user", $_SESSION["id"]);
$pdoStat->bindParam(":id_product", $_POST["id_product"]);

if ($pdoStat->execute() === true) {
    print("sucess");
}
