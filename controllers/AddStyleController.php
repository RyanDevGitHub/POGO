<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
$title_style = "";
$echec = false;
//Database connection
require(include_path('database/db.php'));
if (isset($_POST['title_style'])) {
  $data = $pdo->prepare("SELECT title_style FROM styles");
  $title_style = $_POST['title_style'];
  if ($title_style === "") {
    $echec = true;
    $succes = "[ECHEC] S'il vous plaît , veuillez rentrer au moins 1 caractère.";
  }

  $check_style = $pdo->query("SELECT title_style FROM styles");
  while ($data_style = $check_style->fetch()) {
    if ($data_style['title_style'] === $title_style) {
      $echec = true;
      $succes = "[ECHEC] La Style '$title_style' existe déjà dans la base de données.";
    }
  }
  if (!$echec) {

    include_once(include_path('database/db.php'));;
    $pdoStat = $pdo->prepare("INSERT INTO styles (title_style) VALUES (:title_style)");
    $pdoStat->bindParam(":title_style", $title_style);
    $pdoStat->execute();

    $succes = "La base de données a bien été mise à jour.";
  }
};
include(include_path('includes/add_style.php'));
