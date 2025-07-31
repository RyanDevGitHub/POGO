<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
if (isset($_GET['id_producte'])) {
    // GET ID PRODUCT FROM $_GET
    $id_product = intval($_GET['id_producte']);

    // DELETE IN SQL
    require_once(include_path('database/db.php'));
    $delete = $pdo->query("DELETE FROM productes WHERE id_producte = $id_product");
    $deleteIsOk = $delete->execute();

    // CHECK DELETE IS OK

    if ($deleteIsOk === true) {
        redirect("views/profil-admin.php?page=InfosProduit");
        die();
    } else {
        echo "NO";
    }
}
