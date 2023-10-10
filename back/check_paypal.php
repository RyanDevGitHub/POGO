<?php
$isMail = false;
$isPw = false;
if(isset($_POST['retourner'])){
    header('location: ../carts.php');
}else{
    if(isset($_POST['mail_nb']) && !empty($_POST['mail_nb'])){
        if (filter_var($_POST['mail_nb'], FILTER_VALIDATE_EMAIL) || strlen($_POST['mail_nb']) == 10 && is_numeric($_POST['mail_nb'])) {
            $isMail = true;
        }
    }
    if(isset($_POST['pwd']) && !empty($_POST['pwd'])){
        $isPw = true;
    }
    
    if($isMail && $isPw){
        header('location: ./paiement.php');
        die();
    }else{
        header('location: ../paypal.php');
    }
}