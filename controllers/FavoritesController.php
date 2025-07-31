<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
//requete sql recupere tous les favoris de l 'id user 
include_once(include_path('database/db.php'));;

// prepare query SQL

$pdoStat = $pdo->prepare("SELECT id_producte FROM favorites WHERE id_user = :id");

// add value to marqueur

$pdoStat->bindParam(':id', $_SESSION['id']);

//start query

$pdoStat->execute();

$row = $pdoStat->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($row as $key => $value) {
        $id = $value['id_producte'];

        // recupere les info de l'article
        $pdoStat = $pdo->prepare("SELECT title_producte,price_producte,quantity_producte,desc_producte,image_producte FROM productes WHERE id_producte = :id");

        // remplacment des marqueur 
        $pdoStat->bindParam('id', $id);

        //start query
        $pdoStat->execute();

        $row_producte = $pdoStat->fetchAll();

        foreach ($row_producte as $key => $value) {


            print($value['title_producte'] . '<img src="data:image/jpeg;base64,' . base64_encode($value['image_producte']) . '"/>');
        }
    }
    ?>
    <div>
        <h1></h1>

    </div>

</body>

</html>