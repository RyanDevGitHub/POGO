<!--HEAD-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="../css/page_paiement.css?v=1">
</head>
<!-- fin HEAD-->

<body>
    <!--HEADER-->
    <header>
        <div class="head">
            <a href="../accueil.php" class="logo"><img src="../res/Pogo3sansfond.png" alt=""></a>
            <h1>PAIEMENT</h1>
        </div>
    </header>
    <!--HEADER-->
    <!--DEBUT SECTION-->
    <section>
        <div class="container">
            <div class="column">
                <div class="A">
                    <div class="info-livraison">
                        <p class="title">INFORMATION SUR LA LIVRAISON</p>
                        <a href="../profil.php?sectionProfile=myAccount&note=paiement"><i
                                class="fa-light fa-pen"></i></a>
                    </div>
                    <ul>
                        <?php if (empty($rowUser['first_name']) || empty($rowUser['last_name']) || empty($rowUser['adresse']) || empty($rowUser['mobile']) || empty($rowUser['email'])) {
                            echo "<font style='font-size:70%;' color = red>*Veuillez remplir les champs </font><br>";
                        } ?>
                        <li>Nom Prenom : <?php echo $rowUser['last_name'] . " " . $rowUser['first_name']; ?></li>
                        <li>Adresse : <?php echo $rowUser['adresse']; ?></li>
                        <li>Numeros : <?php echo $rowUser['mobile']; ?></li>
                        <li>Email : <?php echo $rowUser['email']; ?></li>

                    </ul>
                </div>
                <div class="B">
                    <div class="Mode-de-paiement">
                        <p>Mode de Paiement</p>
                        <div class="form-mode-de-paiement">

                            <form action="../paypal.php" method="GET">
                                <input type="submit" value="paypal" <?php if (empty($rowUser['first_name']) || empty($rowUser['last_name']) || empty($rowUser['adresse']) || empty($rowUser['mobile']) || empty($rowUser['email'])) {
                                                                        echo "disabled= 'disabled'";
                                                                    } ?>>
                            </form>
                            <form action="../cb.php" method="GET">
                                <input type="submit" value="CB" <?php if (empty($rowUser['first_name']) || empty($rowUser['last_name']) || empty($rowUser['adresse']) || empty($rowUser['mobile']) || empty($rowUser['email'])) {
                                                                    echo "disabled= 'disabled'";
                                                                } ?>>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="C">
                <div class="article-row">
                    <p class="title"><?php echo $piece; ?> ARTICLE</p>
                    <a href="../carts.php"><i class="fa-light fa-pen"></i></a>
                </div>
                <h2 class="rc">RECAPITULATIF DE COMMANDE</h2>
                <p>Total des articles (<?php echo $piece; ?> pièces) <?php echo $total; ?> €</p>
                <p>code Promo</p>
                <p>Frais de livraison <?php echo $livrai; ?> €</p>
                <h2 class="pt">PRIX TOTALE <?php echo $totalGene; ?>€</h2>
                <p>TVA incluse dans le total</p>
            </div>
        </div>
        <?php
        include('../reseaux.php');
        ?>
    </section>
    <!--FIN SECTION-->

    <!--DEBUT FOOTER-->
    <?php
    include('../footer.php');
    ?>
    <!--DEBUT FOOTER-->

</body>

</html>