<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
print_r($_GET);
print_r($_SESSION);
//// VERIFIVIER QUE LE CLEINT NA PAS DEJA FAIT UN AVIS SUR LARTICLE//
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("SELECT id_avis FROM avis WHERE id_user = :id_user AND product_id = :product_id");
$pdoStat->bindParam(":id_user", $_SESSION['id']);
$pdoStat->bindParam(":product_id", $_GET["id_product"]);
$pdoStat->execute();
$row = $pdoStat->fetchAll();
print_r($row);
//SI LE CLEINT A PAS DEJA FAIT UN AVIS AJOUTER AVIS A BASE DE DONNER ET RETOURNER UN MESSAGE DE SUCCEE//
if (count($row) === 0) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("INSERT INTO avis (id_user,product_id,title_avis,desc_avis,note_avis) VALUES (:id_user,:product_id,:title_avis,:desc_avis,:note_avis)");
    $pdoStat->bindParam(":id_user", $_SESSION["id"]);
    $pdoStat->bindParam(":product_id", $_GET["id_product"]);
    $pdoStat->bindParam(":title_avis", $_GET["title_avis"]);
    $pdoStat->bindParam(":desc_avis", $_GET["desc_avis"]);
    $pdoStat->bindParam(":note_avis", $_GET["star"]);
    $pdoStat->execute();
    $_SESSION["avis"] = "good";
    redirect('views/article-zoom.php?id_product=' . $_GET['id_product']);
} else {
    //SI LE CLIENT A DEJA FAIT UN AVIS RETOUNER UN MESSAGE  "VOUS AVEZ DEJA FAIT UN  AViS //
    redirect('views/article-zoom.php?id_product=' . $_GET['id_product']);
    $_SESSION["avis"] = "fail";
}
