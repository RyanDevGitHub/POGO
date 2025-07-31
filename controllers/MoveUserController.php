<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();

include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("SELECT pseudo,first_name,last_name,genre,email,mobile,adresse,code_postal,mdp FROM users WHERE id_user = :id");
$pdoStat->bindParam(":id", $_SESSION['id']);
$pdoStat->execute();
$result = $pdoStat->fetchAll();
// var_dump($_GET);

//VARIABLE SESSION 
$_SESSION['resulte-true'] = true;
$_SESSION['class-error email'] = "";
$_SESSION['class-error adresse'] = "";
$_SESSION['class-error numeros'] = "";
$_SESSION['class-error code_postal'] = "";
$_SESSION['class-error name'] = "";
$_SESSION['class-error first_name'] = "";
$_SESSION['class-error mdp'] = "";
$_SESSION['class-error pseudo'] = "";
$_SESSION['class-error city'] = "";



//VERIFICATION TOUS LES CHAMP SONT REMPLIS

if (empty($_GET['email'])) {
    $_SESSION['class-error email'] = "active";
}
if (empty($_GET['adresse'])) {
    $_SESSION['class-error adresse'] = "active";
}
if (empty($_GET['code_postal'])) {
    $_SESSION['class-error code_postal'] = "active";
}
if (empty($_GET['numero'])) {
    echo "ici";
    $_SESSION['class-error numeros'] = "active";
}
if (empty($_GET['name'])) {
    $_SESSION['class-error name'] = "active";
}
if (empty($_GET['firstname'])) {
    $_SESSION['class-error first_name'] = "active";
}
if (empty($_GET['password'])) {
    $_SESSION['class-error mdp'] = "active";
}
if (empty($_GET['pseudo'])) {
    $_SESSION['class-error pseudo'] = "active";
}
if (empty($_GET['city'])) {
    $_SESSION['class-error city'] = "active";
}

$password = $_GET['password'];
$seconde_password = $_GET['seconde_password'];

$code_postal = false;
$emailIsOk = false;
$adresseIsOk = false;
$numeroIsOk = false;
$nameIsOk = false;
$firstnameIsOk = false;
$passwordIsOk = false;
$seconde_passwordIsOK = false;
$pseudoIsOk = false;
$cityIsOk = false;
$styleIsOk = false;

/////////// VERIFICATION STYLE ////////////////
if (isset($_GET['style'])) {
    $id_style = floatval($_GET['style']);
    $styleIsOk = true;
}


///////////   VERIFIFCATION CITY //////////////
$testcity = str_replace(array(' ', '-'), '', $_GET['city']);
if (ctype_alpha($testcity) === false) {
    echo 'fail city';
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error city'] = "active";
} else {
    //$_GET['city'] = str_replace(array(" "), "", $_GET['city']);
    $_GET['city'] = strtoupper($_GET['city']);
    $cityIsOk = true;
}

$_GET['pseudo'] = ($_GET['pseudo']);
$_GET['name'] = ($_GET['name']);
$_GET['firstname'] = ($_GET['firstname']);

//////////   VERIFACATION PSEUDO HAVE GOOD CARACTERE  ////////////////

if (strlen($_GET['pseudo']) > 50 || strlen($_GET['pseudo']) < 2) {
    echo "fail pseudo good caractere";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error pseudo'] = "active";
} else {
    $pseudoIsOk = true;
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
            $pseudoIsOk = false;
            echo "fail pseudo good caractere";
            $_SESSION['resulte-true'] = false;
            $_SESSION['class-error pseudo'] = "active";
        }
    }
}
//////////   FIN PSEUDO HAVE GOOD CARACTERE  ////////////////

//////////   VERIFACATION NOM ////////////////

if (strlen($_GET['name']) > 50 || strlen($_GET['name']) < 2) {
    echo "fail name";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error name'] = "active";
} else {
    $nameIsOk = true;
    for ($i = 0; $i < strlen($_GET['name']); $i++) {
        $ascii = mb_ord($_GET['name'][$i], "ISO-8859-15");
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
            $nameIsOk = false;
            echo "fail pseudo good caractere";
            $_SESSION['resulte-true'] = false;
            $_SESSION['class-error name'] = "active";
        }
    }
}
//////////   VERIFACATION PRENOM  ////////////////

if (strlen($_GET['firstname']) > 50 || strlen($_GET['firstname']) < 2) {
    echo "fail firstname";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error first_name'] = "active";
} else {
    $firstnameIsOk = true;
    for ($i = 0; $i < strlen($_GET['firstname']); $i++) {
        $ascii = mb_ord($_GET['firstname'][$i], "ISO-8859-15");
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
            $firstnameIsOk = false;
            echo "fail pseudo good caractere";
            $_SESSION['resulte-true'] = false;
            $_SESSION['class-error first_name'] = "active";
        }
    }
}

//////////   VERIFACATION MOBILE  ////////////////

if (strlen($_GET['numero']) !== 10 ||  ctype_digit($_GET['numero']) === false) {
    echo "fail numero";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error numeros'] = "active";
} else {
    $numeroIsOk = true;
    echo "good numero </br>";
}

//////////   VERIFACATION CODE POSTAL  ////////////////

if (strlen($_GET['code_postal']) !== 5 ||  ctype_digit($_GET['code_postal']) === false) {
    echo "fail code_postal";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error code_postal'] = "active";
} else {
    $code_postal = true;
    echo "good code_postal </br>";
}

//////////   VERIFACATION ADRESSE  ////////////////

if (empty($_GET['adresse']) || $_GET['adresse'] === "") {
    echo "fail adresse";
    $_SESSION['resulte-true'] = false;
    $_SESSION['class-error adresse'] = "active";
} else {
    $code_postal = true;
    echo "good adresse </br>";
}

//////////   VERIFACATION PASSWORD IS GOOD  ////////////////
if (md5($_GET['password']) === $result[0]['mdp']) {
    $passwordIsOk = true;
    echo "good password  regarde </br>";
} else {
    $_SESSION['class-error mdp'] = "active";
}


//////////   VERIFACATION NEW PASSWORD CONATAINE NUMBER MAJ AND SPECIAL CARACTERE ////////////////
if ($passwordIsOk === true) {
    $mdpHaveNumber = false;
    $mdpHaveSymbole = false;
    $mdpHaveMaj = false;
    for ($i = 0; $i < strlen($_GET['seconde_password']); $i++) {
        $ascii = ord($_GET['seconde_password'][$i]);
        print($ascii . "</br>");
        if ($ascii >= 65 && $ascii <= 90) {
            $mdpHaveMaj = true;
            print("majOK");
        } elseif ($ascii >= 48 && $ascii <= 57) {
            $mdpHaveNumber = true;
            print("numberOK");
        } elseif (
            $ascii >= 33 && $ascii <= 47
            || $ascii >= 58 && $ascii <= 64
            || $ascii === 91 || $ascii >= 93 && $ascii <= 96
            || $ascii === 123 || $ascii >= 125 && $ascii <= 126
        ) {
            $mdpHaveSymbole = true;
            print("SYMBOLEOK");
        }
    }

    if ($mdpHaveMaj === true && $mdpHaveNumber === true && $mdpHaveSymbole === true) {
        $seconde_passwordIsOK = true;
        print('good seconde_password </br>');
    } else {
        $_SESSION['class-error mdp'] = "active";
        print('fail seconde_password </br>');
    }
}
//////////   VERIFACATION ADRESSE EMAIL GOOD WRITE AND IS NOT USE for another account ////////////////

if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {


    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare('SELECT email FROM users');
    $executeIsOk = $pdoStat->execute();
    $email_list = $pdoStat->fetchAll();

    $emailExisting = false;

    foreach ($email_list as $value) {
        foreach ($value as $key => $valeur) {
            if ($valeur === $_GET['email']) {
                $emailExisting = true;
            }
        }
    }
    if ($emailExisting === false) {
        $emailIsOk = true;
        echo "good email </br>";
    } else {
    }
} else {
    $_SESSION['resulte-false'] = false;
    echo "fail email";
}
//////////   SEND  STYLE DATA IN DATABASE  ////////////////
if ($styleIsOk) {

    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET style = :style WHERE id_user = :id");
    $pdoStat->bindParam(':style', $id_style);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();
}

//////////   SEND  PSEUDO DATA IN DATABASE  ////////////////
if ($pseudoIsOk === true) {
    $_GET['pseudo'] = ($_GET['pseudo']);
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET pseudo = :pseudo WHERE id_user = :id");
    $pdoStat->bindParam(':pseudo', $_GET['pseudo']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change pseudo </br>";
}

//////////   SEND FIRST NAME DATA IN DATABASE  ////////////////
var_dump($firstnameIsOk);
if ($firstnameIsOk === true) {
    $_GET['firstname'] = ($_GET['firstname']);
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET first_name = :firstname WHERE id_user = :id");
    $pdoStat->bindParam(':firstname', $_GET['firstname']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();
}

//////////   SEND NAME DATA IN DATABASE  ////////////////
if ($nameIsOk === true) {
    $_GET['name'] = ($_GET['name']);
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET last_name = :lastname WHERE id_user = :id ");
    $pdoStat->bindParam(':lastname', $_GET['name']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change name </br>";
}

//////////   SEND EMAIL DATA IN DATABASE  ////////////////
if ($emailIsOk === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET email = :email WHERE id_user = :id");
    $pdoStat->bindParam(':email', $_GET['email']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change email </br>";
}
//////////   SEND ADRESSE DATA IN DATABASE  ////////////////
if ($adresseIsOk === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET adresse = :adresse WHERE id_user = :id");
    $pdoStat->bindParam(':adresse', $_GET['adresse']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change email </br>";
}

//////////   SEND NUMERO DATA IN DATABASE  ////////////////
if ($numeroIsOk === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET mobile = :mobile WHERE id_user = :id");
    $pdoStat->bindParam(':mobile', $_GET['numero']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change email </br>";
}

//////////   SEND CODE POSTAL DATA IN DATABASE  ////////////////
if ($code_postal === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET code_postal = :code_postal WHERE id_user = :id");
    $pdoStat->bindParam(':code_postal', $_GET['code_postal']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change code_postal </br>";
}
//////////   SEND ADRESSE DATA IN DATABASE  ////////////////
if ($numeroIsOk === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET adresse = :adresse WHERE id_user = :id");
    $pdoStat->bindParam(':adresse', $_GET['adresse']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change adresse </br>";
}

//////////   SEND PASSWORD DATA IN DATABASE  ////////////////
if ($passwordIsOk === true && $seconde_passwordIsOK === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET mdp = :mdp WHERE id_user = :id");
    $password = md5($_GET['seconde_password']);
    $pdoStat->bindParam(':mdp', $password);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change password </br>";
}
///////// SEND CITY IN DATABASE //////////////////////////

if ($cityIsOk === true) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET city = :city WHERE id_user = :id");
    $password = md5($_GET['seconde_password']);
    $pdoStat->bindParam(':city', $_GET['city']);
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change password </br>";
}

//////////   SEND GENRE DATA IN DATABASE  ////////////////
if (isset($_GET['gender']) &&  $_GET['gender'] === 'male') {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET genre = 'H' WHERE id_user = :id");
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change genre </br>";
}

if (isset($_GET['gender']) &&  $_GET['gender'] === 'female') {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE users SET genre = 'F' WHERE id_user = :id");
    $pdoStat->bindParam(':id', $_SESSION['id']);
    $pdoStat->execute();

    echo "change genre </br>";
}
if (isset($_GET['note']) && $_GET['note'] == "paiement") {
    redirect("views/profil-admin.php?modify=on&note=paiement");
} else if ($_GET['mode'] === 'admin') {
    redirect("views/profil-admin.php?page=MonProfil&modify=on");
} else {
    redirect("views/profil-admin.php?modify=on");
}
