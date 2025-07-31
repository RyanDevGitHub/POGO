<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();

if (isset($_GET['idPro']) && isset($_POST['quantity'])) {
    $id_user = $_SESSION['id'];
    $idProduct = $_GET['idPro'];
    //SEARCH INFOS PRODUCT IN TABLE CART
    include(include_path('database/db.php'));
    $dataCart = $pdo->query("SELECT * FROM cart WHERE id_user = $id_user AND statue = 'in progrese';");

    // ACTION EDIT
    while ($row = $dataCart->fetch()) {
        if (intval($row['id_producte']) === intval($_GET['idPro'])) {
            $idCart = intval($row['id_cart']);
            $quantity = intval($_POST['quantity']);
            $quantityPro = $quantityPro + (intval($row['quantity']) - intval($_POST['quantity']));

            $insert =  $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE id_cart = :id_cart;");
            $insert->bindParam(':quantity', $quantity);
            $insert->bindParam(':id_cart', $idCart);

            $updateIsOk = $insert->execute();
        }
    }

    redirect('views/carts.php');
}
