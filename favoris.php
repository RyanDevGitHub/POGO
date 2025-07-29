<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/favoris.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("./HeaderNav.php");
    ?>
    <section>
        <?php
        include_once("./database/db.php");
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
            <a href="./page-article-zoom.php?id_product=<?php echo $rowPro['id_producte']; ?>">
                <div class="article">
                    <img class=img_article src="./res/photo_product/<?php echo $rowPro['image_producte']; ?>" alt="">
                    <p class="title_article"><?php echo $rowPro['title_producte']; ?></p>
                    <p class="description-article"><?php echo $rowPro['desc_producte'] ?></p>
                    <p class="prix_article"><?php echo $rowPro['price_producte']; ?> €</p>

                    <div class="note-stock">
                        <img class="note_article" src="./res/note_producte/<?php print($row[0]) ?>STARS.png " alt="">
                        <p class="stock_article"><?php  ?></p>
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
    include("./reseaux.php");
    include("./footer.php");
    ?>
    <script src="./JavaScript/favoris.js"></script>

</body>

</html>