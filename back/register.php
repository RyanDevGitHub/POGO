
<?php
session_start();
header('Content-type: text/html; charset=ISO-8859-1');
$_SESSION['register-fail'] = "";
$_SESSION['error-message'] = "";
$_SESSION['pseudo'] = $_GET['pseudo'];
$_SESSION['email'] = $_GET['email'];
$mdpIsGood = false;


$_GET['pseudo'] = utf8_decode($_GET['pseudo']);

//VERIFICATION TOUS LES CHAMP SONT REMPLIS et 
if (
    empty($_GET['pseudo']) === false &&
    empty($_GET['email']) === false &&
    empty($_GET['mdp']) === false &&
    empty($_GET['verefmdp']) === false
) {

    //////////   VERIFACATION PSEUDO HAVE GOOD CARACTERE  ////////////////
    $pseudoHavGoodcaractere = true;

    for ($i = 0; $i < strlen($_GET['pseudo']); $i++) {
        $ascii = mb_ord($_GET['pseudo'][$i], "ISO-8859-15");
        if (
            $ascii >= 65 && $ascii <= 90 ||
            $ascii >= 97 && $ascii <= 122 ||
            $ascii >= 192 && $ascii <= 221 ||
            $ascii >= 224 && $ascii <= 246 ||
            $ascii >= 249 && $ascii <= 255 ||
            $ascii == 45 ||
            $ascii == 39
        ) {
        } else {
            $pseudoHavGoodcaractere = false;
            echo 'fail pseudo';
            $_SESSION['error-message'] = "Votre pseudo ne respecte pas le site";
            header("Location: ../index.php");
        }
    }
    if ($pseudoHavGoodcaractere === true) {
    }
    //////////   FIN PSEUDO HAVE GOOD CARACTERE  ////////////////

    //////////   VERIFACATION PSEUDO  ////////////////
    if (strlen($_GET['pseudo']) > 50 || strlen($_GET['pseudo']) <= 2 || $pseudoHavGoodcaractere === false) {
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "Votre pseudo ne respecte pas le site";
        header("Location: ../index.php");
    } else {
        $pseudoIsOk = true;
    }

    //////////   VERIFACATION PSEUDO IS DIFERENTE  ////////////////
    if ($pseudoIsOk === true) {
        $pseudoExisting = false;
        include('../database/db.php');
        $pdoStat = $pdo->prepare('SELECT pseudo FROM users');
        $pdoStat->execute();
        $pseudoarray = $pdoStat->fetchAll();
        foreach ($pseudoarray as $value) {
            foreach ($value as $valeur) {
                if ($valeur === $_GET['pseudo']) {
                    $pseudoExisting = true;
                    $_SESSION['register-fail'] = "active";
                    $_SESSION['error-message'] = "votre pseudo est deja associer a un compte ";

                    header("Location: ../index.php");
                }
            }
        }
    }

    //////////   VERIFACATION ADRESSE EMAIL IS NOT USE AND IS GOOD WRITE ////////////////

    if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        include('../database/db.php');
        //préparation de la requête

        $pdoStat = $pdo->prepare('SELECT email FROM users');

        //execution de la requête preparer

        $executeIsOk = $pdoStat->execute();

        //recuperation des résultat

        $email = $pdoStat->fetchAll();
        $emailExisting = false;
        foreach ($email as $value) {
            foreach ($value as $key => $valeur) {
                if ($valeur === $_GET['email']) {
                    $emailExisting = true;
                    $_SESSION['register-fail'] = "active";
                    $_SESSION['error-message'] = "votre email est deja associer a un compte ";
                    header("Location: ../index.php");
                }
            }
        }
    } else {
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "L'adresse email est invalide";
        header("Location: ../index.php");
    }



    ////////       VERIFICATION PASSWORD  /////////
    if (
        $_GET['mdp'] === $_GET['verefmdp'] &&
        strlen($_GET['mdp']) >= 4
    ) {
        $mdpIsGood = true;
    } else {
        $mdpIsGood = false;
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "Votre mot de passe doit contenir minimum 4 caractere (Maj,Num,Symbole) et être identique dans les deux champ";
        header("Location: ../index.php");
    }

    //////////   VERIFACATION NEW PASSWORD CONATAINE NUMBER MAJ AND SPECIAL CARACTERE ////////////////
    if ($mdpIsGood === true) {
        $mdpHaveNumber = false;
        $mdpHaveSymbole = false;
        $mdpHaveMaj = false;
        for ($i = 0; $i < strlen($_GET['mdp']); $i++) {
            $ascii = ord($_GET['mdp'][$i]);
            print($_GET['mdp'] . "   $ascii </br>");
            if ($ascii >= 65 && $ascii <= 90) {
                $mdpHaveMaj = true;
            } elseif ($ascii >= 48 && $ascii <= 57) {
                $mdpHaveNumber = true;
            } elseif (
                $ascii >= 33 && $ascii <= 47
                || $ascii >= 58 && $ascii <= 64
                || $ascii === 91 || $ascii >= 93 && $ascii <= 96
                || $ascii === 123 || $ascii >= 125 && $ascii <= 126
            ) {
                $mdpHaveSymbole = true;
            }
        }

        if ($mdpHaveMaj === true && $mdpHaveNumber === true && $mdpHaveSymbole === true) {
            $seconde_passwordIsOK = true;
        } else {
            echo 'fail mdp pas les symbole';
            $_SESSION['register-fail'] = "active";
            $_SESSION['error-message'] = "Mot de passe ne contient pas maj num symb";

            header("Location: ../index.php");
        }
    }

    //////////   VERIFACATION CHECKBOX IS ON ////////////////

    if (isset($_GET['checkbox']) === false) {
        $_SESSION['register-fail'] = "active";
        $_SESSION['error-message'] = "Veiller confirmer etre agé d'au moins 18 ans ";
        header("Location: ../index.php");
    }

    //////////   SEND DATA IN DATABASE  ////////////////
    if ($seconde_passwordIsOK === true && $pseudoExisting === false && $emailExisting === false && $_GET['checkbox'] == 1) {
        $_GET['pseudo'] = utf8_encode($_GET['pseudo']);
        include('../database/db.php');

        //preparation de la requête d'insertion (SQL)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdoStat = $pdo->prepare("INSERT INTO users (pseudo,email,mdp) VALUES(:pseudo,:email,:mdp)");

        //on lie chaque marqueur à une valeur

        $pdoStat->bindParam(':pseudo', $_GET["pseudo"]);
        $pdoStat->bindParam(':email', $_GET["email"]);
        $password = md5($_GET['mdp']);
        $pdoStat->bindParam(':mdp', $password);
        print_r($_GET["pseudo"] . " " . $_GET["email"] . " " . $_GET["mdp"]);

        //execution de la requête preparer

        $insertIsOk = $pdoStat->execute();

        //redirection sur la page accueil

        var_dump($insertIsOk);
        if ($insertIsOk === true) {

            header("Location: ./auth.php?email=" . $_GET["email"] . "&mdp=" . $_GET["mdp"]);
        }
    }
} else {
    $_SESSION['register-fail'] = "active";
    $_SESSION['error-message'] = "tous les champs ne sont pas remplie";
    header("Location: ../index.php");
}
?>