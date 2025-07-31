<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();

//VERIFICATION TOUS LES CHAMP SONT REMPLIS

if (
    empty($_GET['email']) === false &&
    empty($_GET['mdp']) === false
) {
    //REQUETE SQUI SELECTE ID USER EMAIL ET MDP DE LA TABLE USER 

    include(include_path('database/db.php'));

    //préparation de la requête

    $pdoStat = $pdo->prepare('SELECT id_user,email,mdp,pseudo,statue FROM users');

    //execution de la requête preparer

    $executeIsOk = $pdoStat->execute();

    //recuperation des ligne email,mdp,id_user

    $row = $pdoStat->fetchAll();
    $ConnexionGood = false;
    foreach ($row as $key => $value) {
        //recuperation email
        if ($value['email'] === $_GET['email'] && $value['mdp'] === md5($_GET['mdp'])) {
            $ConnexionGood = true;
            $_SESSION['id'] = $value['id_user'];
            $_SESSION['pseudo'] = $value['pseudo'];
            $_SESSION['statue'] = $value['statue'];
        }
    }
    if ($ConnexionGood === true) {
        echo '<script>console.log("La connexion est bonne.");</script>';
        redirect('views/accueil.php?msg=register');
        die();
    } else {
        echo '<script>console.log("La connexion est mauvaise.");</script>';
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "mdp ou email incorecte";
        redirect('index.php?action=login.php');
        die();
    }
} else {
    $_SESSION['register-fail'] = "active";
    $_SESSION['error-message'] = "tous les champs ne sont pas remplie";
    redirect('index.php?action=login.php');
    die();
}
