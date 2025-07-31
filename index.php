<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/controllers/include/function.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset("assets/css/style.css?v=2") ?>">


<body>
    <?php
    include(include_path('controllers/RouterController.php'));
    ?>
    <?php
    include(include_path('includes/reseaux.php'));
    ?>
    <!--DEBUT FOOTER-->
    <?php
    include(include_path('includes/footer.php'));
    ?>
    <script src="<?php echo asset('assets/js/index.js') ?>"></script>

    <!--DEBUT FOOTER-->
</body>

</html>