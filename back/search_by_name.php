<?php

if(isset($_POST['productName'])){
    $productName = $_POST['productName'];
    include_once('./database/db.php');
    $data = $pdo -> query("SELECT * FROM productes WHERE title_producte LIKE '%$productName%';");
    $productArr = [];
    while($rowPro = $data -> fetch()){
        $productArr[$rowPro['title_producte']]['id_producte'] = $rowPro['id_producte'];
        $productArr[$rowPro['title_producte']]['imagePro'] = $rowPro['image_producte'];
        $productArr[$rowPro['title_producte']]['titlePro'] = $rowPro['title_producte'];
        $productArr[$rowPro['title_producte']]['desc'] = $rowPro['desc_producte'];
        $productArr[$rowPro['title_producte']]['quantity'] = intval($rowPro['quantity_producte']);
        $productArr[$rowPro['title_producte']]['price'] =$rowPro['price_producte'];
    }
    // if(!empty($productArr)){
    //     header("location: ../product_by_name.php");
    // }
}