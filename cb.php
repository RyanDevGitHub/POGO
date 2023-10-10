<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/cb.css?v=2">
</head>

<body>
    <section>

        <div class="formulaire">

            <form class="form" action="./back/check_CB.php" method="POST">
                <div class="menu-form">
                    <h1>Paiement</h1>
                </div>
                <div class="input-form">
                    <div class="form-group owner">
                        <label for="owner">Nom de carte</label>
                        <input type="text" class="form-control" name="owner">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Numéro de carte</label>
                        <input type="text" class="form-control" name="cardNumber" maxlength="16">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv" maxlength="3">
                    </div>
                    <div class="form-group1" id="expiration-date">
                        <label>Date d'expiration</label>
                        <select name="month">
                            <option value="01">Janvier</option>
                            <option value="02">Février </option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août </option>
                            <option value="09">Septembre </option>
                            <option value="10">Octobre </option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                        <select name="year">
                            <option value="22"> 2022</option>
                            <option value="23"> 2023</option>
                            <option value="24"> 2024</option>
                            <option value="25"> 2025</option>
                            <option value="26"> 2026</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="./res/CB-1.jpg" id="visa">

                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="confirm-purchase">Payer</button>
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="confirm-purchase" name="retourner" value="retourner">Retour</button>
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


    <!--DEBUT FOOTER-->
</body>

</html>


<header>
    <img src="./res/Pogo3sansfond.png" alt="">
</header>