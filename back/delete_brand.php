<?php
if(isset($_GET['id_brand'])){
    // GET ID BRAND FROM $_GET
    $id_brand = intval($_GET['id_brand']);

    // DELETE IN SQL
    require_once('./database/db.php');
    $delete = $pdo -> query("DELETE FROM brands WHERE id_brand = $id_brand");
    $deleteIsOk = $delete->execute();

    // CHECK DELETE IS OK

    if ($deleteIsOk === true) {
        header("Location: ./profil-admin.php?page=brandManagement");
        die();
    }else{
        echo "NO";
    }
}
