<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
$_SESSION['error'] = "";
$_SESSION['row'] = "";
print($_GET['search-bar']);

include(include_path('database/db.php'));

$pdoStat = $pdo->prepare("SELECT id_user,pseudo,first_name,last_name,genre,email,mobile,adresse,code_postal,statue FROM users WHERE pseudo = :pseudo");
$pdoStat->bindParam(":pseudo", $_GET['search-bar']);
$pdoStat->execute();
$row = $pdoStat->fetchAll();

print_r($row);
//redirection error
if (empty($row)) {
    echo 'fail';
    $_SESSION['error'] = "active";
    redirect("views/profil-admin.php?page=InfosClient&info-client=active&error=active");
} else {
    $_SESSION['row'] = $row;
    redirect("views/profil-admin.php?page=InfosClient&info-client=active&container-info-client=active");
}
