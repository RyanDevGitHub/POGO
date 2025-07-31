<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
$_SESSION['error'] = "";
// CHECK KEYWORD EXIST //
include(include_path('database/db.php'));
$pdoStat = $pdo->prepare("SELECT keys_word_title FROM keyswords ");
$pdoStat->execute();
$result = $pdoStat->fetchAll();
$key_word_exist = false;
foreach ($result as $key => $value) {
    print_r($value["keys_word_title"]);
    if ($value["keys_word_title"] === $_GET['name_new_key_word']) {
        $key_word_exist = true;
    }
}



// CHECK KEYWORD GOOD //
var_dump($key_word_exist);
if (ctype_alpha($_GET['name_new_key_word']) && $key_word_exist === false && strlen($_GET['name_new_key_word']) >= 2 && strlen($_GET['name_new_key_word']) <= 25) {
    echo 'ok';
    include(include_path('database/db.php'));
    $pdoStat = $pdo->prepare("INSERT INTO keyswords (keys_word_title) VALUES (:keyname)");
    $pdoStat->bindParam(":keyname", $_GET['name_new_key_word']);
    $pdoStat->execute();
    redirect('views/profil-admin?page=manageKeyWord&error=off');
    $_SESSION['error'] = "off";
} else {
    redirect('views/profil-admin?page=manageKeyWord&error=on');
    $_SESSION['error'] = "on";
}
