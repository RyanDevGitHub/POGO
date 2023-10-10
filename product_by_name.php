<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/search_by_name.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("./HeaderNav.php");
    ?>
    <section>
        <?php include('./back/search_by_name.php') ?>
        <h2 id="titleRes">Résultats de recherche pour "<?php echo $productName; ?>"</h2>
        <div class="contentPro">
            <?php
            
            foreach($productArr as $cle) {
            ?>
            <a href="./page-article-zoom.php?id_product=<?php echo $cle['id_producte']; ?>">
                <div class="article">
                    <img class=img_article src="./res/photo_product/<?php echo $cle['imagePro']; ?>" alt="">
                    <p class="title_article"><?php echo $cle['titlePro']; ?></p>
                    <p class="prix_article"><?php echo $cle['price']; ?> €</p>
                    <div class="note-stock">
                        <img class="note_article" src="./res/5-etoiles-png-5.png" alt="">
                        <p class="stock_article"><?php echo $cle['quantity']; ?></p>
                    </div>
                </div>
            </a>
            <?php
        }


        ?>
        </div>
    </section>
    <?php
    include("./reseaux.php");
    include("./footer.php");
    ?>

</body>

</html>