<?php
session_start();
if (!$_SESSION['statue'])
    header("Location: ./index.php");

$_SESSION['keyswords'] = [];
include_once("./database/db.php");
$data = $pdo->query("SELECT * FROM keyswords");
$rowkeyword = $data->fetchAll();
foreach ($rowkeyword as $keyword) {
    array_push($_SESSION['keyswords'], $keyword[1]);
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
    <link rel="stylesheet" href="./css/accueil.css">
</head>
<!-- fin HEAD-->

<body>
    <!--HEADER-->
    <?php
    include('./HeaderNav.php');
    ?>
    <!--HEADER-->
    <!-- DEBUT SECTION SLIDER -->
    <section class="slider" id="slider">
        <img class="slide active" src="./res/slider1.jpeg" alt="">
        <img class="slide" src="./res/slider2.jpeg" alt="">
        <img class="slide" src="./res/slider3.jpeg" alt="">
        <img class="slide" src="./res/slider4.jpeg" alt="">
        <img class="slide" src="./res/slider5.jpeg" alt="">
    </section>
    <!-- FIN SECTION SLIDER -->
    <!--DEBUT SECTION-->
    <section class="News">
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
                    <a href="./page-article-zoom.php?id_product=<?php echo $rowPro[$i]['id_producte']; ?>">
                        <div class="item">
                            <img class="img-follow" src="./res/photo_product/<?php echo $rowPro[$i]['image_producte']; ?>" alt="">
                            <p class="title_article"><?php echo $rowPro[$i]['title_producte']; ?></p>
                            <p class="prix_article"><?php echo $rowPro[$i]['price_producte']; ?> €</p>
                            <div class="note-stock">
                                <img class="note_article star" src="./res/note_producte/<?php if ($row[0]) {
                                                                                            print($row[0]);
                                                                                        } ?>STARS.png" alt="">
                                <p class="stock_article"><?php if (intval($rowPro[$i]['quantity_producte'] > 0)) {
                                                                echo $rowPro[$i]['quantity_producte'];
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
        include('./reseaux.php');
        ?>
    </section>
    <!--FIN SECTION-->

    <!--DEBUT FOOTER-->
    <?php
    include('./footer.php');
    ?>
    <!--DEBUT FOOTER-->
</body>
<script src="./JavaScript/accueil.js"> </script>

</html>