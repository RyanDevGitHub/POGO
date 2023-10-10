<?php
session_start();

if(isset($_GET['idPro']) && !empty($_GET['idPro'])){
    $id_user = $_SESSION['id'];
    $idPro = intval($_GET['idPro']);
    //SEARCH INFOS PRODUCT IN TABLE CART
    include("../database/db.php");
    $dataPro = $pdo -> query("SELECT * FROM cart WHERE id_user = $id_user AND statue = 'in progrese';");

    // ACTION EDIT
    while($row = $dataPro -> fetch()){
        if(intval($row['id_producte']) === $idPro){
            $idCart = intval($row['id_cart']);
            $delete = $pdo -> prepare("DELETE FROM cart WHERE id_cart = $idCart;");
            $deleteIsOk = $delete -> execute();
        }
    }
    header("Location: ../carts.php");
}

// if(isset($_GET['idPro']) && !empty($_GET['idPro'])){
//     unset($_SESSION['cart'][$_GET['idPro']]);
//     header("Location: ../carts.php");
// }
?>