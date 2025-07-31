<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
?>
<!--HEAD-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/profil-admin.css?v=2') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/product.css?v1') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/add_product.css?v=3') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/base.css') ?>">
</head>
<!-- fin HEAD-->
<?php

session_start();
if ($_SESSION['statue'] === 'admin') {
    include(include_path('includes/header.php'));
    include(include_path('includes/section-profil-admin.php'));
    include(include_path('includes/reseaux.php'));
    include(include_path('includes/footer.php'));
} else {
    print('ERROR 404 CETTE PAGE EST PAS DISPONIBLE');
}
?>