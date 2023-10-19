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
    <script src="https://ww.paypal.com/sdk/js?client-id=Ac2Qlp2PmOKd4eicwlZ1VvwYBojOONCONEKoKJB9iNIj4AQH4KBFOvRr58ZPlsbsb2AW3oGMM5EtXoFf&currency=USD"></script>
    <section>
        <div class="panel">
            <div class="overlay hidden"><div class="overlay-content"><img src="css/loading.gif" alt="Processing..."/></div></div>

            <div class="panel-heading">
                <h3 class="panel-title">Charge <?php ?> with PayPal</h3>
                
                <!-- Product Info -->
                <p><b>Item Name:</b> <?php  ?></p>
                <p><b>Price:</b> <?php  ?></p>
            </div>
            <div class="panel-body">
                <!-- Display status message -->
                <div id="paymentResponse" class="hidden"></div>
                
                <!-- Set up a container element for the button -->
                <div id="paypal-button-container"></div>
            </div>
        </div>
        <script>
            paypal.Buttons({
                createOrder: (data,action) => {
                    return action.order.create({
                        "purchase_units": [{
                            "custom_id":"<?php echo "12" ?>",
                            "description":"<?php echo "testItemName" ?>",
                            "amount": {
                                "currency_code":"<?php  ?>",
                                "value": "<?php  ?>",
                                "breakdown": {
                                    "item_total": {
                                        "currency_code":"<?php ?>",
                                        "value": "<?php ?>"
                                    }
                                }
                            },
                            "items":[
                                {
                                    "name": "<?php  ?>",
                                    "description": "<?php  ?>",
                                    "unit_amount":{
                                        "currency_code":"<?php  ?>",
                                        "value":"<?php  ?>"
                                    },
                                    "quantity": 1,
                                    "category":"DIGITAL_GOODS"
                                }
                            ]
                        }]
                    })
                },
                onApprove: (date, action ) => {
                    return action.order.capture().then(function(orderData){

                    });
                }

            }).render('#paypal-button-container');

            const encodeFormData = (data) => {
                var form_data = new FormData();

                for(var key in data ){
                    form_data.append(key,data[key]);
                }
                return form_data;
            }


          
        </script>

        <!-- <div class="formulaire">

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
        </div> -->

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