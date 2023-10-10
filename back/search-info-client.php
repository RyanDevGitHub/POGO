<?php
session_start();
$_SESSION['error'] = "";
$_SESSION['row'] = "";
var_dump($_GET);
var_dump($_SESSION);
print($_GET['search-bar']);

include("../database/db.php");

$pdoStat = $pdo->prepare("SELECT id_user,pseudo,first_name,last_name,genre,email,mobile,adresse,code_postal,statue FROM users WHERE pseudo = :pseudo");
$pdoStat->bindParam(":pseudo", $_GET['search-bar']);
$pdoStat->execute();
$row = $pdoStat->fetchAll();

print_r($row);
//redirection error
if (empty($row)) {
    echo 'fail';
    $_SESSION['error'] = "active";
    header("Location: ../profil-admin.php?page=InfosClient&info-client=active&error=active");
} else {
    $_SESSION['row'] = $row;
    header("Location: ../profil-admin.php?page=InfosClient&info-client=active&container-info-client=active");
}
