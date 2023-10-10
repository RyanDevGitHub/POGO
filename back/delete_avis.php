<?php
session_start();
include("../database/db.php");
$pdoStat = $pdo->prepare("DELETE FROM avis WHERE id_avis = :id ");
$pdoStat->bindParam(":id", $_GET["id_avis"]);
$pdoStat->execute();
var_dump($_SESSION);
header("Location: ../page-article-zoom.php?id_product=" . $_SESSION["id_product"]);
