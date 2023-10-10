<!--HEAD-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/profil-admin.css?v=2">
    <link rel="stylesheet" href="./css/product.css?v1">
    <link rel="stylesheet" href="./css/add_product.css?v=3">
</head>
<!-- fin HEAD-->
<?php
session_start();
if ($_SESSION['statue'] === 'admin') {
    include("./header.php");
    include("./section-profil-admin.php");
    include("./reseaux.php");
    include("./footer.php");
} else {
    print('ERROR 404 CETTE PAGE EST PAS DISPONIBLE');
}