<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$combLen = strlen($comb);
$pass = array();
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $combLen - 1);
    array_push($pass, $comb[$n]);
}
$newpassword = (implode($pass));
$newpassword = $newpassword . "A1!";
$password = $newpassword;

include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("UPDATE users SET mdp = :mdp WHERE email = :email");
$password = md5($password);
$pdoStat->bindParam(':mdp', $password);
$pdoStat->bindParam(':email', $_POST['email']);
if ($pdoStat->execute()) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("SELECT email,pseudo FROM users where email = :email");
    $pdoStat->bindParam(':email', $_POST['email']);
    $pdoStat->execute();
    $row = $pdoStat->fetchAll();

    $dest = ($_POST['email']);
    $sujet = "Le mot de passe de votre compte a été modifié";
    $corp = "Mot de passe mis à jour \n Bonjour " . $row[0]["pseudo"] . "\n Votre mot de passe a été modifier comme vous l'avez demander.\n Voici votre mot de passe temporaire $newpassword  . \n pour vous connecter avec celui ci cliquer sur ce lien http://pogogithub/index.php?action=login.php";
    $headers = "From: pogo@gmail.com";
    if (mail($dest, $sujet, $corp, $headers) === true && sizeof($row) !== 0) {
        echo "Email envoyé avec succès";
    } else {
        echo "Échec de l'envoi de l'email";
    }
} else {
    echo "Échec de l'envoi de l'email";
}
