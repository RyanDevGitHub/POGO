<?php
//VERIFIER PAS DEJA EN FAVORIS//
require_once dirname(__DIR__) . '/controllers/include/function.php';
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("SELECT * FROM favorites WHERE id_user = :id_user AND id_producte = :id_producte");
$pdoStat->bindParam(':id_user', $_POST['id_user']);
$pdoStat->bindParam(':id_producte', $_POST['id_producte']);
$pdoStat->execute();
$row = $pdoStat->fetchAll();

if (sizeof($row) == 0) {
    //AJOUTER EN FAVORIS//

    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("INSERT INTO favorites (id_user,id_producte) VALUES (:id_user , :id_producte)");
    $pdoStat->bindParam(':id_user', $_POST['id_user']);
    $pdoStat->bindParam(':id_producte', $_POST['id_producte']);
    $pdoStat->execute();
    echo 'favoris_add';
} else {
    echo 'favoris_exist';
}
