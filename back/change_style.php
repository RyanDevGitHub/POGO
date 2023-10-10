<?php
$echec = false;
//Database connection
require('./database/db.php');


//search id
$id_style = $_GET['id_style'];
$search_id = $pdo -> prepare("SELECT title_style FROM styles WHERE id_style = :id_style;");
$search_id->bindParam(':id_style', $id_style);
$search_id->execute();

$data_id = $search_id-> fetch();
$title_style = $data_id["title_style"];

//check brand
if(isset($_POST['title_style'])){
  $data = $pdo -> prepare("SELECT title_style FROM styles");
    $title_style = $_POST['title_style'];
    if($title_style === ""){
      $echec = true;
      $succes = "[ECHEC] S'il vous plaît , veuillez rentrer au moins 1 caractère.";

    }

    $check_style = $pdo-> query("SELECT title_style FROM styles");
    while ($data_styles = $check_style->fetch()){
      if($data_styles['title_style'] === $title_style){
          $echec = true;
          $succes = "[ECHEC] La marque '$title_style' existe déjà dans la base de données.";
      }
    }
    if (!$echec){
      $add = $pdo->prepare("UPDATE styles SET title_style = :title_style WHERE id_style = :id_style;");
      $add->bindParam(':title_style', $title_style);
      $add->bindParam(':id_style', $id_style);
      $add->execute();
      $succes = "La base de données a bien été mise à jour.";
    }
};

include('./include_change_style.php');