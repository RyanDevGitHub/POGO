<?php
session_start();
var_dump($_GET);
var_dump($_SESSION);
$vide = "";
switch ($_GET['input_delete']) {
    case 'adresse':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET adresse = :adresse WHERE id_user = :id");
        $pdoStat->bindParam(':adresse', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    case 'numero':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET mobile = :mobile WHERE id_user = :id");
        $pdoStat->bindParam(':mobile', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    case 'code_postal':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET code_postal = :code_postal WHERE id_user = :id");
        $pdoStat->bindParam(':code_postal', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    case 'nom':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET last_name = :lastname WHERE id_user = :id ");
        $pdoStat->bindParam(':lastname', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    case 'prenom':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET first_name = :firstname WHERE id_user = :id");
        $pdoStat->bindParam(':firstname', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    case 'pseudo':
        include('../database/db.php');
        $pdoStat = $pdo->prepare("UPDATE users SET pseudo = :pseudo WHERE id_user = :id");
        $pdoStat->bindParam(':pseudo', $vide);
        $pdoStat->bindParam(':id', $_SESSION['row']['0']['id_user']);
        $pdoStat->execute();
        header("Location: /back/search-info-client?search-bar=" . $_SESSION['row'][0]['pseudo']);
        break;
    default:
        header("Location: /profil-admin.php?page=InfosClient&info-client=active&modify-profil-client=active");
}
