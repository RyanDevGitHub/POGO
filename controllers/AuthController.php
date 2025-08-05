<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();


// 🎯 Mode invité : accès sans login


if (isset($_GET['guest']) && $_GET['guest'] === 'true') {

    $_SESSION['id'] = null;
    $_SESSION['pseudo'] = 'Invité';
    $_SESSION['statue'] = 'guest';

    echo '<script>console.log("Connexion invité réussie.");</script>';
    redirect('views/accueil.php?msg=guest');
    die();
}

// ✅ Vérification des champs
if (!empty($_GET['email']) && !empty($_GET['mdp'])) {
    include(include_path('database/db.php'));

    $pdoStat = $pdo->prepare('SELECT id_user, email, mdp, pseudo, statue FROM users');
    $executeIsOk = $pdoStat->execute();

    $row = $pdoStat->fetchAll();
    $ConnexionGood = false;

    foreach ($row as $value) {
        if ($value['email'] === $_GET['email'] && $value['mdp'] === md5($_GET['mdp'])) {
            $ConnexionGood = true;
            $_SESSION['id'] = $value['id_user'];
            $_SESSION['pseudo'] = $value['pseudo'];
            $_SESSION['statue'] = $value['statue'];
        }
    }

    if ($ConnexionGood) {
        echo '<script>console.log("La connexion est bonne.");</script>';
        redirect('views/accueil.php?msg=register');
        die();
    } else {
        echo '<script>console.log("La connexion est mauvaise.");</script>';
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "Email ou mot de passe incorrect";
        redirect('index.php?action=login.php');
        die();
    }
} else {
    $_SESSION['register-fail'] = "active";
    $_SESSION['error-message'] = "Tous les champs ne sont pas remplis";
    redirect('index.php?action=login.php');
    die();
}
