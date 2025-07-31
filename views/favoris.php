<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/favoris.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include(include_path('includes/headerNav.php'));
    ?>
    <section>
        <?php
        include_once(include_path('database/db.php'));
        $data = $pdo->prepare("SELECT *
        FROM productes
        WHERE productes.id_producte IN (
            SELECT favorites.id_producte
            FROM favorites
            WHERE favorites.id_user = :id
          )");
        $data->bindParam(":id", $_SESSION['id']);
        $data->execute();

        while ($rowPro = $data->fetch()) {
            $pdostat = $pdo->prepare("SELECT ROUND(AVG(note_avis))
            FROM avis
            WHERE product_id = :product_id");
            $pdostat->bindParam(":product_id", $rowPro["id_producte"]);
            $pdostat->execute();
            $row = $pdostat->fetch();

        ?>
            <a href="<?php echo route('views/article-zoom.php?id_product=') ?><?php echo $rowPro['id_producte']; ?>">
                <div class="article">
                    <img class=img_article src="<?php echo asset('assets/imgs/img-products/') ?><?php echo $rowPro['image_producte']; ?>" alt="">
                    <p class="title_article"><?php echo $rowPro['title_producte']; ?></p>
                    <p class="description-article"><?php echo $rowPro['desc_producte'] ?></p>
                    <p class="prix_article"><?php echo $rowPro['price_producte']; ?> €</p>

                    <div class="note-stock">
                        <img class="note_article" <?php echo asset('assets/imgs/rating-stars/') ?><?php print($row[0]) ?>STARS.png " alt="">
                        <p class=" stock_article"><?php  ?></p>
                    </div>
                    <?php //var_dump($rowPro); 
                    ?>
                    <button id="button_delete_favori" class="verify" type="button" onclick="delete_favoris(<?php print($rowPro[0]) ?>)">SUPPRIMER</button>
                </div>
            </a>
        <?php
        }


        ?>
    </section>
    <?php
    include(include_path('includes/reseaux.php'));
    include(include_path('includes/footer.php'));
    ?>
    <script src="<?php echo asset('assets/js/favoris.js') ?>"></script>

</body>

</html>