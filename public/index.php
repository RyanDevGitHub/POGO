<?php
// public/index.php
require_once __DIR__ . '../controllers/include/function.php';
// Sécurité basique : éviter l'injection dans l'URL
$page = htmlspecialchars($_GET['page'] ?? 'accueil');

// Liste des pages autorisées
$routes = [
    'accueil' => include_path('views/accueil.php'),
    'produits' => include_path('views/produit.php'),,
    // ajoute ici d'autres routes
];

// Si la page demandée existe, on l’inclut
if (array_key_exists($page, $routes)) {
    include $routes[$page];
} else {
    // page 404 basique
    echo "<h1>404 - Page introuvable</h1>";
}
