<?php
//GET CLIENTS INFOS FROM DATABASE
require_once dirname(__DIR__) . '/controllers/include/function.php';


//print_r($rowUser);

if (isset($_GET['piece']) && isset($_GET['total']) && isset($_GET['livrai']) && isset($_GET['totalGene'])) {
    $piece = intval($_GET['piece']);
    $total = floatval($_GET['total']);
    $livrai = intval($_GET['livrai']);
    $totalGene = floatval($_GET['totalGene']);
} else {
    $piece = 0;
    $total = 0;
    $livrai = 0;
    $totalGene = 0;
}
include(include_path('views/paiement.php'));
