<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
$isMail = false;
$isPw = false;
if (isset($_POST['retourner'])) {
    redirect("controllers/CartsController.php");
} else {
    if (isset($_POST['mail_nb']) && !empty($_POST['mail_nb'])) {
        if (filter_var($_POST['mail_nb'], FILTER_VALIDATE_EMAIL) || strlen($_POST['mail_nb']) == 10 && is_numeric($_POST['mail_nb'])) {
            $isMail = true;
        }
    }
    if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
        $isPw = true;
    }

    if ($isMail && $isPw) {
        redirect('controllers/PaiementController.php');
        die();
    } else {
        redirect('controllers/PaypalController.php');
    }
}
