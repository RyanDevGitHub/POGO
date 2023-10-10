<?php
session_start();
include('../database/db.php');
$idUser = $_SESSION['id'];
 
// GET INFOS CART FROM CART TABLE
$dataCart = $pdo -> query("SELECT * FROM cart WHERE id_user = $idUser AND statue = 'in progrese'");
$rowCart = $dataCart -> fetchAll();

$dataPro = $pdo -> query("SELECT * FROM productes;");
$rowPro = $dataPro -> fetchAll();

foreach($rowCart as $cart => $valueCart){
    foreach($rowPro as $pro => $valuePro){
        if(intval($valueCart['id_producte']) == intval($valuePro['id_producte'])){
            $idProduct = intval($valueCart['id_producte']);
            $newQuant = max(0,intval($valuePro['quantity_producte']) - intval($valueCart['quantity']));

            $addPro = $pdo->prepare("UPDATE productes SET quantity_producte = :quantityPro WHERE id_producte = :id_pro");
            $addPro->bindParam(':quantityPro', $newQuant);
            $addPro->bindParam(':id_pro', $idProduct);
            $updateProIsOk = $addPro ->execute();
        }
    }
}

$dateCommande = date("Y-m-d");
$livrer = $pdo -> prepare("UPDATE cart SET statue = 'livrer', date_commande	= '$dateCommande' WHERE id_user = $idUser AND statue = 'in progrese'");
$livrer -> execute();


if($livrer && $addPro){
    header('location:../accueil.php');
}else{
    echo 'non';
}