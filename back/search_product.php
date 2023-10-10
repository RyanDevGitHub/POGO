<?php

if(isset($_GET['id_product'])){
    $idProduct = $_GET['id_product'];
    include_once('./database/db.php');
    $data = $pdo -> query("SELECT * FROM productes WHERE id_producte = $idProduct;");
    while($rowPro = $data -> fetch()){
        $imagePro = $rowPro['image_producte'];
        $titlePro = $rowPro['title_producte'];
        $desc = $rowPro['desc_producte'];
        $quantity = intval($rowPro['quantity_producte']);
    }
}

