<?php
include("../database//db.php");
$pdoStat = $pdo->prepare("DELETE FROM keyswords WHERE id_keys_word = :id");
$pdoStat->bindParam(":id", $_POST["id"]);
$pdoStat->execute();
