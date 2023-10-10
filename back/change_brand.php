<?php
$echec = false;
//Database connection
require('./database/db.php');


//search id
$id_brand = $_GET['id_brand'];
$search_id = $pdo -> prepare("SELECT title_brand FROM brands WHERE id_brand = :id_brand;");
$search_id->bindParam(':id_brand', $id_brand);
$search_id->execute();

$data_id = $search_id-> fetch();
$title_brand = $data_id["title_brand"];

//check brand
if(isset($_POST['title_brand'])){
  $data = $pdo -> prepare("SELECT title_brand FROM brands");
    $title_brand = $_POST['title_brand'];
    if($title_brand === ""){
      $echec = true;
      $succes = "[ECHEC] S'il vous plaît , veuillez rentrer au moins 1 caractère.";

    }

    $check_brand = $pdo-> query("SELECT title_brand FROM brands");
    while ($data_brands = $check_brand->fetch()){
      if($data_brands['title_brand'] === $title_brand){
          $echec = true;
          $succes = "[ECHEC] La marque '$title_brand' existe déjà dans la base de données.";
      }
    }
    if ($echec !== true){
      $add = $pdo->prepare("UPDATE brands SET title_brand = :title_brand WHERE id_brand = :id_brand;");
      $add->bindParam(':title_brand', $title_brand);
      $add->bindParam(':id_brand', $id_brand);
      $add->execute();
      $succes = "La base de données a bien été mise à jour.";
    }
};

include('./change_brand.php');
