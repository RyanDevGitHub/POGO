<?php
// Include the configuration file  
require_once '../config/configPaypal.php';
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
    <link rel="stylesheet" href="../css/page_paiement.css?v=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/base.css">
</head>
<!-- fin HEAD-->

<body>
    <?php include('../header.php'); ?>
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
                        <p id="title_payment">Mode de Paiement</p>
                        <div class="form-mode-de-paiement">
                            <form action="#" method="GET">
                                <div id="paypal-button-container"></div>
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

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>
<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                "purchase_units": [{
                    "custom_id": "<?php echo $itemNumber; ?>",
                    "description": "<?php echo $itemName; ?>",
                    "amount": {
                        "currency_code": "<?php echo $currency; ?>",
                        "value": <?php echo $totalGene; ?>,
                        "breakdown": {
                            "item_total": {
                                "currency_code": "<?php echo $currency; ?>",
                                "value": <?php echo $totalGene; ?>
                            }
                        }
                    },
                    "items": [{
                        "name": "<?php echo $itemName; ?>",
                        "description": "<?php echo $itemName; ?>",
                        "unit_amount": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $totalGene; ?>
                        },
                        "quantity": "1",
                        "category": "DIGITAL_GOODS"
                    }, ]
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                setProcessing(true);
                var postData = {
                    paypal_order_check: 1,
                    order_id: orderData.id
                };
                fetch('paypal_checkout_validate.php', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json'
                        },
                        body: encodeFormData(postData)
                    })
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.status == 1) {
                            window.location.href = "payment-status.php?checkout_ref_id=" + result.ref_id;
                        } else {
                            const messageContainer = document.querySelector("#paymentResponse");
                            messageContainer.classList.remove("hidden");
                            messageContainer.textContent = result.msg;

                            setTimeout(function() {
                                messageContainer.classList.add("hidden");
                                messageText.textContent = "";
                            }, 5000);
                        }
                        setProcessing(false);
                    })
                    .catch(error => console.log(error));
            });
        }
    }).render('#paypal-button-container');

    const encodeFormData = (data) => {
        var form_data = new FormData();

        for (var key in data) {
            form_data.append(key, data[key]);
        }
        return form_data;
    }

    // Show a loader on payment form processing
    const setProcessing = (isProcessing) => {
        if (isProcessing) {
            document.querySelector(".overlay").classList.remove("hidden");
        } else {
            document.querySelector(".overlay").classList.add("hidden");
        }
    }
</script>