<?php
session_start();
if (!$_SESSION['statue'])
    header("Location: ./index.php");
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
    <link rel="stylesheet" href="./css/carts.css?v=2">
</head>
<!-- fin HEAD-->

<body>
    <!--HEADER-->
    <?php
    include('./HeaderNav.php');
    ?>
    <!--HEADER-->
    <!--DEBUT SECTION-->
    <section>
        <div class="carte-section">
            <div class="carte">
                <?php
                $itemIsOk = false;

                include("./database/db.php");

                if ($_SESSION['id']) {
                    $idUser = intval($_SESSION['id']);
                }
                $data = $pdo->query("SELECT * FROM cart INNER JOIN productes ON cart.id_producte = productes.id_producte
                WHERE id_user = $idUser AND statue = 'in progrese';");
                $piece = 0;
                $total = 0;
                $livraison = 0;
                $totalGene = 0;
                while ($row = $data->fetch()) {

                    $itemIsOk = true;
                    $piece += intval($row['quantity']);
                    $total += floatval($row['price_producte']) * intval($row['quantity']);
                ?>
                    <div class="itemCart">
                        <div class="imgProduct">
                            <img height="150px" width="100px" src="./res/photo_product/<?php echo $row['image_producte']; ?>">
                        </div>
                        <div class="infosProduct">
                            <p class="prixPro"><?php echo $row['price_producte']; ?> €</p>
                            <p class="titlePro"><?php echo $row['title_producte']; ?></p>
                            <p class="size"></p>
                        </div>
                        <div class="editCart">
                            <form id="formQuantity" action="./back/edit_quantity.php?idPro=<?php echo $row['id_producte']; ?>" method="POST">
                                <input id="inputQuant" type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min=1>
                                <button id="btnQuantity">Modifier</button>
                            </form>
                            <a class="linkCart" href="./back/delete_product_cart.php?idPro=<?php echo $row['id_producte']; ?>">Supprimer</a>
                        </div>
                    </div>

                <?php
                }
                if ($total >= 50 || $total == 0) {
                    $totalGene = $total;
                } else {
                    $livraison = 4.99;
                    $totalGene = $total + $livraison;
                }
                if (!$itemIsOk) {
                ?>
                    <h4 class='panier'>Votre panier est vide</h4>
                <?php
                }
                ?>

            </div>
            <div class="resume">
                <div class="title-paiment">
                    <h4 class="paiement">Paiement</h4>
                </div>
                <div class="title-resume-container">
                    <div class="title-resume">
                        <h4>Résumé</h4>
                        <?php

                        ?>
                        <p>totale des articles (<?php echo $piece; ?> pièce) :
                            <?php echo $total; ?> €</p>
                        <p>Livraison et traitement : <?php echo $livraison; ?> €</p>
                    </div>
                    <div class="title-resume">
                        <h4>Total géneral : <?php echo $totalGene; ?> € </h4>
                        <p>TVA incluse dans le totale</p>
                    </div>
                    <div class="button-resume">
                        <form class="btn_resume" action="./page-article.php">
                            <input type="submit" value="RETOUR">
                        </form>
                        <form class="btn_resume" action="./back/search_cart.php?piece=<?php echo $piece; ?>&total=<?php echo $total; ?>&livrai=<?php echo $livraison; ?>&totalGene=<?php echo $totalGene; ?>" method="POST">
                            <input type="submit" value="PAYER" <?php if ($piece == 0) {
                                                                    echo "disabled= 'disabled'";
                                                                } ?>>
                        </form>
                    </div>
                </div>
            </div>
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
    <script src="/accueil.js"></script>
</body>

</html>