<?php
$key = key($_POST);

//////////   VERIFACATION NEW PASSWORD CONATAINE NUMBER MAJ AND SPECIAL CARACTERE ////////////////
$mdpHaveNumber = false;
$mdpHaveSymbole = false;
$mdpHaveMaj = false;
for ($i = 0; $i < strlen($_POST[$key]); $i++) {
    $ascii = ord($_POST[$key][$i]);
    if ($ascii >= 65 && $ascii <= 90) {
        $mdpHaveMaj = true;
    } elseif ($ascii >= 48 && $ascii <= 57) {
        $mdpHaveNumber = true;
    } elseif (
        $ascii >= 33 && $ascii <= 47
        || $ascii >= 58 && $ascii <= 64
        || $ascii === 91 || $ascii >= 93 && $ascii <= 96
        || $ascii === 123 || $ascii >= 125 && $ascii <= 126
    ) {
        $mdpHaveSymbole = true;
    }
}

if ($mdpHaveMaj === true && $mdpHaveNumber === true && $mdpHaveSymbole === true && strlen($_POST[$key]) >= 2 && strlen($_POST[$key]) <= 25) {
    $seconde_passwordIsOK = true;
    echo 'good_mdp';
} else {
    echo 'fail_mdp';
}
