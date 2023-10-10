<?php

$user = "root";
$pass = "";
$pdo = new PDO('mysql:host=localhost;dbname=projet_pi_pogo', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
