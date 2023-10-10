<?php
include('../database/db.php');
$param = "%" . $_POST['search'] . "%";
$pdoStat = $pdo->prepare("SELECT pseudo FROM users WHERE pseudo LIKE :pseudo ORDER BY pseudo");
$pdoStat->bindParam(':pseudo', $param);
$executeIsOk = $pdoStat->execute();
$row = $pdoStat->fetchAll();
echo json_encode($row);
