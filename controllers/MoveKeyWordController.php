<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
// CHECK KEYWORD EXIST //
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("SELECT keys_word_title FROM keyswords ");
$pdoStat->execute();
$result = $pdoStat->fetchAll();
$key_word_exist = false;
foreach ($result as $key => $value) {
    if ($value["keys_word_title"] === $_POST['value']) {
        $key_word_exist = true;
    }
}

if (ctype_alpha($_POST['value']) && $key_word_exist === false && strlen($_POST['value']) >= 2 && strlen($_POST['value']) <= 25) {
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("UPDATE keyswords SET keys_word_title  = :new_keys_word_title WHERE id_keys_word = :id");
    $pdoStat->bindParam(":id", $_POST["id"]);
    $pdoStat->bindParam(":new_keys_word_title", $_POST["value"]);
    $pdoStat->execute();
} else {
    echo "Votre Mot Clé doit contenir uniquement des lettre";
}
