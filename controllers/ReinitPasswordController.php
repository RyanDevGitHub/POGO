<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$combLen = strlen($comb);
$pass = array();
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $combLen - 1);
    array_push($pass, $comb[$n]);
}
$password = (implode($pass));
$password = $password . "A1!";

$dest = ($_SESSION['row'][0]['email']);
$sujet = "Changement de mot de passe POGO";
$corp = "Mot de passe mis à jour \n Bonjour \n Votre mot de passe a été modifier comme vous l'avez demander.\n Voici votre mot de passe temporaire $password  . \n pour vous connecter avec celui ci cliquer sur ce lien http://pogogithub/index.php?action=login.php";
$headers = "From: pogo@gmail.com";
if (mail($dest, $sujet, $corp, $headers) === true) {
    echo "Email envoyé avec succès";
} else {
    echo "Échec de l'envoi de l'email";
}

include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("UPDATE users SET mdp = :mdp WHERE id_user = :id");
$password = md5($password);
$pdoStat->bindParam(':mdp', $password);
$pdoStat->bindParam(':id', $_SESSION['row'][0]['id_user']);
$pdoStat->execute();
