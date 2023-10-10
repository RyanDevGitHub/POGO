<?php
$echec = false;
//Database connection
require('./database/db.php');


//search id
$id_categorie = $_GET['id_categorie'];
$search_id = $pdo -> prepare("SELECT title_categorie FROM categories WHERE id_categorie = :id_categorie;");
$search_id->bindParam(':id_categorie', $id_categorie);
$search_id->execute();

$data_id = $search_id-> fetch();
$title_categorie = $data_id["title_categorie"];

//check categorie
if(isset($_POST['title_categorie'])){
  $data = $pdo -> prepare("SELECT title_categorie FROM categories");
    $title_categorie = $_POST['title_categorie'];
    if($title_categorie === ""){
      $echec = true;
      $succes = "[ECHEC] S'il vous plaît , veuillez rentrer au moins 1 caractère.";

    }

    $check_categorie = $pdo-> query("SELECT title_categorie FROM categories");
    while ($data_categories = $check_categorie->fetch()){
      if($data_categories['title_categorie'] === $title_categorie){
          $echec = true;
          $succes = "[ECHEC] La catégorie '$title_categorie' existe déjà dans la base de données.";
      }
    }
    if ($echec !== true){
      $add = $pdo->prepare("UPDATE categories SET title_categorie = :title_categorie WHERE id_categorie = :id_categorie;");
      $add->bindParam(':title_categorie', $title_categorie);
      $add->bindParam(':id_categorie', $id_categorie);
      $add->execute();
      $succes = "La base de données a bien été mise à jour.";
    }
};

include('./change_categorie.php');
