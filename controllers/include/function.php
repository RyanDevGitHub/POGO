<?php

// Récupère le chemin depuis la racine du domaine jusqu'au dossier du projet
$baseFolder = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/');

define('BASE_URL', $baseFolder === '' ? '/' : $baseFolder);
define('BASE_PATH', dirname(dirname(__DIR__)));
function asset(string $path): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST']; // ex : localhost ou pogo

    return rtrim($scheme . '://' . $host, '/') . '/' . ltrim($path, '/');
}
function include_path(string $path): string
{
    return BASE_PATH . '/' . ltrim($path, '/');
}
function redirect(string $path): void
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST']; // exemple : pogo ou localhost

    // On part toujours de la racine du domaine
    $location = rtrim($scheme . '://' . $host, '/') . '/' . ltrim($path, '/');

    header("Location: $location");
    exit;
}
function route(string $path): string
{
    return asset($path);
}
