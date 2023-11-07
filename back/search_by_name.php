<?php

if(isset($_POST['productName'])){
    $productName = $_POST['productName'];
    include_once('./database/db.php');

    $sql = ("SELECT productes.id_producte,productes.title_producte , productes.price_producte , productes.desc_producte ,productes.image_producte,productes.quantity_producte
    FROM productes
    JOIN keysword_producte kp ON productes.id_producte = kp.producte_id
    JOIN keyswords k ON kp.keyswords_id = k.id_keys_word
    WHERE LOWER(k.keys_word_title) = LOWER(:productName);");

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productsList = array();
    foreach($data as $row){
        $id = $row['id_producte'];
        $title = $row['title_producte'];
        $price = $row['price_producte'];
        $description = $row['desc_producte'];
        $image = $row['image_producte'];
        $quantity = $row['quantity_producte'];
    
        // Créez un tableau associatif pour chaque produit
        $product = array(
            'id' => $id,
            'title' => $title,
            'price' => $price,
            'description' => $description,
            'image' => $image,
            'quantity' => $quantity
        );
        $productsList[] = $product;
    }
    // if(!empty($productArr)){
    //     header("location: ../product_by_name.php");
    // }
}
