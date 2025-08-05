<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['statue'] !== 'admin' && $_SESSION['statue'] !== 'guest' && $_SESSION['statue'] !== 'client') {
    redirect("index.php");
} else {

    $_SESSION['keyswords'] = [];
    include_once(include_path('database/db.php'));
    $data = $pdo->query("SELECT * FROM keyswords");
    $rowkeyword = $data->fetchAll();
    foreach ($rowkeyword as $keyword) {
        array_push($_SESSION['keyswords'], $keyword[1]);
    }
}
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset('assets/css/accueil.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/base.css') ?>">
</head>
<!-- fin HEAD-->

<body>
    <!--HEADER-->
    <?php

    include(include_path('includes/headerNav.php'));
    ?>
    <!--HEADER-->
    <!-- DEBUT SECTION SLIDER -->
    <section class="slider" id="slider">
        <img class="slide active" src="<?php echo asset('assets/imgs/img-slider/slider1.jpeg') ?>" alt="slider1">
        <img class="slide" src="<?php echo asset('assets/imgs/img-slider/slider2.jpeg') ?>" alt="slider2">
        <img class="slide" src="<?php echo asset('assets/imgs/img-slider/slider3.jpeg') ?>" alt="slider3">
        <img class="slide" src="<?php echo asset('assets/imgs/img-slider/slider4.jpeg') ?>" alt="slider4">
        <img class="slide" src="<?php echo asset('assets/imgs/img-slider/slider5.jpeg') ?>" alt="slider5">
    </section>
    <!-- FIN SECTION SLIDER -->
    <!--DEBUT SECTION-->
    <section class="news">
        <h2 id='title'>Nos Nouveautés</h2>
        <div class="section-article column">
            <?php
            $data = $pdo->query("SELECT * FROM productes ORDER BY id_producte ASC");
            $rowPro = $data->fetchAll();

            if (count($rowPro) > 0) {
                for ($i = 0; $i < count($rowPro); $i++) {
                    $pdostat = $pdo->prepare("SELECT ROUND(AVG(note_avis))
                FROM avis
                WHERE product_id = :product_id");
                    $pdostat->bindParam(":product_id", $rowPro[$i]['id_producte']);
                    $pdostat->execute();
                    $row = $pdostat->fetch();
            ?>
                    <a href=" <?php echo asset('views/article-zoom.php?id_product=') ?> <?php echo $rowPro[$i]['id_producte']; ?>">
                        <div class="item">
                            <img class="img-follow" src="<?php echo asset('assets/imgs/img-products/') ?><?php echo $rowPro[$i]['image_producte']; ?>" alt="">
                            <p class="title_article"><?php echo $rowPro[$i]['title_producte']; ?></p>
                            <p class="prix_article"><?php echo $rowPro[$i]['price_producte']; ?> €</p>
                            <div class="note-stock">
                                <img class="note_article star" src="<?php echo asset('assets/imgs/rating-stars/') ?><?php if ($row[0]) {
                                                                                                                        print($row[0]);
                                                                                                                    } ?>STARS.png" alt="">
                                <p class="stock_article"><?php if (intval($rowPro[$i]['quantity_producte'] > 0)) {
                                                            } else {
                                                                echo "épuisé";
                                                            }
                                                            ?></p>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
        <?php
        include(include_path('includes/reseaux.php'));
        ?>
    </section>
    <!--FIN SECTION-->

    <!--DEBUT FOOTER-->
    <?php
    include(include_path('includes/footer.php'));

    ?>
    <!--DEBUT FOOTER-->
</body>
<script src="<?php echo asset('assets/js/accueil.js') ?>"> </script>

</html>