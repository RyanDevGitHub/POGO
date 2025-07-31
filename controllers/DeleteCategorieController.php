<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
if (isset($_GET['id_categorie'])) {
    // GET ID categorie FROM $_GET
    $id_categorie = intval($_GET['id_categorie']);

    // DELETE IN SQL
    require_once(include_path('database/db.php'));
    $delete = $pdo->query("DELETE FROM categories WHERE id_categorie = $id_categorie");
    $deleteIsOk = $delete->execute();

    // CHECK DELETE IS OK

    if ($deleteIsOk === true) {
        redirect("views/profil-admin.php?page=categorieManagement");
        die();
    } else {
        echo "NO";
    }
}
