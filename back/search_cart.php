<?php
//GET CLIENTS INFOS FROM DATABASE
session_start();
$idUser = $_SESSION['id'];
include("../database/db.php");
$dataUser = $pdo -> prepare("SELECT * FROM users WHERE id_user = $idUser;");
$dataUser -> execute();
$rowUser = $dataUser -> fetch();

//print_r($rowUser);


if(isset($_GET['piece']) && isset($_GET['total']) && isset($_GET['livrai']) && isset($_GET['totalGene'])){
    $piece = intval($_GET['piece']);
    $total = floatval($_GET['total']);
    $livrai = intval($_GET['livrai']);
    $totalGene = floatval($_GET['totalGene']);
}
else{
    $piece = 0;
    $total = 0;
    $livrai = 0;
    $totalGene = 0;
}
include('../page-paiement.php');

