<?php
session_start();
var_dump($_GET);

include("../database/db.php");
$pdoStat = $pdo->prepare("UPDATE avis
SET title_avis = :title_avis,
  desc_avis = :desc_avis,
  note_avis = :note_avis
WHERE id_avis = :id_avis");
$pdoStat->bindParam(":title_avis", $_GET["title_avis"]);
$pdoStat->bindParam(":desc_avis", $_GET["desc_avis"]);
if (isset($_GET["star_modify"])) {
  $note_avis = intval($_GET["star_modify"]);
  $pdoStat->bindParam(":note_avis", $note_avis);
} else {
  $note_avis = 0;
  $pdoStat->bindParam(":note_avis", $note_avis);
}
$pdoStat->bindParam(":id_avis", $_GET["id_avis"]);
$pdoStat->execute();
header("Location: ../page-article-zoom.php?id_product=" . $_SESSION["id_product"]);
