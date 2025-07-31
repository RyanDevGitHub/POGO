<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("DELETE FROM keyswords WHERE id_keys_word = :id");
$pdoStat->bindParam(":id", $_POST["id"]);
$pdoStat->execute();
