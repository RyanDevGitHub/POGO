<?php

$user = "if0_39606689";  // ton MYSQL USERNAME
$pass = "umujYK8n4Q";  // MYSQL PASSWORD donné par InfinityFree
$host = "sql109.infinityfree.com";  // MYSQL HOSTNAME
$dbname = "if0_39606689_pogo";  // MYSQL DATABASE NAME

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}


// $user = "root";
// $pass = ""; // pas de mot de passe par défaut sur WAMP
// $host = "127.0.0.1"; // ou localhost
// $dbname = "projet_pi_pogo"; // nom de ta base locale (tu dois la créer via phpMyAdmin)

// $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

// try {
//     $pdo = new PDO($dsn, $user, $pass, [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
//     ]);
// } catch (PDOException $e) {
//     die("Erreur de connexion à la base de données : " . $e->getMessage());
// }
