<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
if (isset($_GET['id_product'])) {
    $idProduct = $_GET['id_product'];
    include_once(include_path('database/db.php'));
    $data = $pdo->query("SELECT * FROM productes WHERE id_producte = $idProduct;");
    while ($rowPro = $data->fetch()) {
        $imagePro = $rowPro['image_producte'];
        $titlePro = $rowPro['title_producte'];
        $desc = $rowPro['desc_producte'];
        $quantity = intval($rowPro['quantity_producte']);
    }
}
