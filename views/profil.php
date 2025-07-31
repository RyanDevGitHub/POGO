<!--HEAD-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/profil.css?v=3') ?>">
</head>
<!-- fin HEAD-->
<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
if ($_SESSION['statue'] === 'client') {
    include(include_path('includes/header.php'));
    include(include_path('includes/section-profil-client.php'));
    include(include_path('includes/reseaux.php'));
    include(include_path('includes/footer.php'));
} else {
    print('ERROR 404 CETTE PAGE EST PAS DISPONIBLE');
}
