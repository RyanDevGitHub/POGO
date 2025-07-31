<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
if (!$_SESSION['statue'])
    redirect("index.php");

include_once(include_path('database/db.php'));
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.They is POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/article.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/base.css') ?>">
</head>

<?php
include(include_path('includes/headerNav.php'));
?>
<div class="article_section">
    <div class="menu_container">
        <?php

        $idUser = $_SESSION['id'];
        $dataUser = $pdo->query("SELECT * FROM styles S INNER JOIN users U ON S.id_style = U.style WHERE id_user = $idUser;");
        $styleUser = $dataUser->fetchAll();


        if (!empty($styleUser)) {
            $isStyle = $styleUser[0]['style'];
            if (!empty($isStyle)) {

                echo "<div class= 'titleStyle'>
                <h2>" . $styleUser[0]['title_style'] . "</h2>
            </div>";
            }
        }

        ?>
        <div>
            <p class="title_menu">Catégorie</p>
            <a href=""><i class="fa-solid fa-plus"></i></a>

        </div>
        <div>
            <p class="title_menu">Marque</p>
            <a href=""><i class="fa-solid fa-plus"></i></a>

        </div>
        <div>
            <p class="title_menu">A la une</p>
            <a href=""><i class="fa-solid fa-plus"></i></a>
        </div>
        <div>
            <p class="title_menu">Gamme de prix</p>
            <a href=""><i class="fa-solid fa-plus"></i></a>
        </div>
        <div>
            <p class="title_menu">Catégorie</p>
            <a href=""><i class="fa-solid fa-plus"></i></a>
        </div>

    </div>
    <div class="article_container">
        <?php
        if (!empty($styleUser) && isset($isStyle)) {
            echo "<div>Ce style ne vous plait plus ? <a id= 'linkModify' href ='" . asset('views/quiz.php') . "'><h2 id = 'linkModifyStyle'>Changer votre style </h2></a></div>";
            $data = $pdo->query("SELECT * FROM productes P LEFT JOIN styles_productes SP ON P.id_producte = SP.producte_id
        LEFT JOIN users U ON U.style = SP.style_id WHERE SP.style_id = $isStyle;");

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
                        <img class=img-article src="<?php echo asset('assets/imgs/img-products/') ?><?php echo $rowPro['image_producte']; ?>" alt="">
                        <p class="title_article"><?php echo $rowPro['title_producte']; ?></p>
                        <p class="prix_article"><?php echo $rowPro['price_producte']; ?> €</p>
                        <div class="note-stock">
                            <img class="note_article" <?php echo asset('assets/imgs/rating-stars/') ?><?php print($row[0]); ?>STARS.png" alt="">
                            <p class="stock_article"><?php if (intval($rowPro['quantity_producte'] > 0)) {
                                                        } else {
                                                            echo "épuisé";
                                                        }
                                                        ?></p>
                        </div>
                    </div>
                </a>
                <a href="<?php
                        }
                    } else {
                        echo route('views/page-quiz.php');
                    }
                            ?>" id='linkModifyStyle'>
                    <h2>Selectioner le Style qui vous correspond le mieux !</h2>
                </a>


                <script src=" <?php echo asset('assets/js/accueil.js') ?>"></script>
    </div>
</div>

<?php
include(include_path('includes/reseaux.php'));
?>

<?php
include(include_path('includes/footer.php'));
?>