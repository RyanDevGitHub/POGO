<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();

//Database connection
require(include_path('database/db.php'));

if (isset($_POST['id_style'])) {
  $data = $pdo->prepare("UPDATE users SET style = :id_style WHERE users.id_user = :id");
  $data->bindParam(':id', $_SESSION['id']);
  $data->bindParam(':id_style', $_POST['id_style']);
  $data->execute();

  $succes = "La base de données a bien été mise à jour.";
  echo $succes;
};
redirect("controllers/StyleArticleController.php");
