<?php
$messNameCarte = "le nom de carte est obligatoire";
$messCarteNb = "Le numéro de carte est obligatoire";
$messCvv = "Le CVV est obligatoire";
$messMonth = "le mois est obligatoire";
$messYear = "l'année est obligatoire";

$isNameCarte = false;
$isCarteNb = false;
$isCvv = false;
$isMonth = false;
$isYear = false;

$cardName = $_POST['owner'];
print($_POST['owner']);
$cardNb = $_POST['cardNumber'];
$cvv = $_POST['cvv'];
$month = $_POST['month'];
$year = $_POST['year'];

if (isset($_POST['retourner'])) {
    header('location: ../carts.php');
} else {
    if (isset($_POST['owner']) && !empty($_POST['owner'])) {
        $isNameCarte = false;

        if (ctype_alpha(preg_replace('/\s+/', '', $_POST['owner']))) {
            $isNameCarte = true;
        } else {
            $messNameCarte = "Le nom de carte est invalide";
        }
    }
    if (isset($_POST['cardNumber']) && !empty($_POST['cardNumber'])) {
        if (is_numeric($_POST['cardNumber']) && strlen($_POST['cardNumber']) == 16) {
            $isCarteNb = true;
        } else {
            $messCarteNb = "Le numéro de carte est invalide";
            echo "y";
        }
    }
    if (isset($_POST['cvv'])  && !empty($_POST['cvv'])) {
        if (is_numeric($_POST['cvv']) && strlen($cvv) == 3) {
            $isCvv = true;
        } else {
            $messCarteNb = "Le numéro de carte est invalide";
        }
    }
    if (isset($_POST['month']) && !empty($_POST['month'])) {
        $isMonth = true;
    }
    if (isset($_POST['year']) && !empty($_POST['year'])) {
        $isYear = true;
    }

    if ($isCarteNb && $isNameCarte && $isCvv && $isMonth && $isYear) {
        header('location: ./paiement.php');
        die();
    } else {
        header('location: ../cb.php');
    }
}
