<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
$idSession = false;
if (isset($_GET['idProduct'])) {
    $idProduct = intval($_GET['idProduct']);
    $idUser = intval($_SESSION['id']);

    //GET INFOS PRODUCT FROM DATABASE
    include(include_path('database/db.php'));
    // $dataPro = $pdo -> query("SELECT * FROM productes WHERE id_producte = $idProduct;");
    // $product = $dataPro -> fetchAll();
    // $quantityPro = intval($product[0]['quantity_producte']);
}
//VERIFY THE SESSION IN THE CART TABLE

$dataCart = $pdo->query("SELECT * FROM cart WHERE id_user = $idUser AND statue = 'in progrese'");

$count = 0;
while ($rows = $dataCart->fetch()) {
    $count++;
    $idCart = intval($rows['id_cart']);
    $idSession = $rows['sessions'];
    $rowIdPro = intval($rows['id_producte']);
    $quantityCart = intval($rows['quantity']);
    if ($rowIdPro === $idProduct) {

        //EDIT QUANTITY IN DATABASE
        $quantityCart++;
        $add = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE id_cart = :id_cart;");
        $add->bindParam(':quantity', $quantityCart);
        $add->bindParam(':id_cart', $idCart);
        $updateIsOk = $add->execute();

        if ($updateIsOk) {
            redirect('views/carts.php');
            die();
        }
    }
}
//GET NEW SESSION 
if (!$idSession) {
    $idSession = uniqid();
}
$quantity = 1;
$statue = 'in progrese';

// SAVE INFOS IN DATABASE

$add = $pdo->prepare("INSERT INTO cart(id_producte,id_user,quantity,statue,sessions) VALUES (:idPro, :idUser, :quantity, :statue, :sessions);");
$add->bindParam(':idPro', $idProduct);
$add->bindParam(':idUser', $idUser);
$add->bindParam(':quantity', $quantity);
$add->bindParam(':statue', $statue);
$add->bindParam(':sessions', $idSession);

$insertIsOk = $add->execute();

if ($insertIsOk) {
    redirect('views/carts.php');
}
