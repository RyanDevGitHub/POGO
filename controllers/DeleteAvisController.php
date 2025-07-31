<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("DELETE FROM avis WHERE id_avis = :id ");
$pdoStat->bindParam(":id", $_GET["id_avis"]);
$pdoStat->execute();
var_dump($_SESSION);
redirect("controllers/ArticleZoomController.php?id_product=" . $_SESSION["id_product"]);
