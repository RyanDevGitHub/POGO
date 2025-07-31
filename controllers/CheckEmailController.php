<?php
$test  = $_POST['email'];
if (filter_var($test, FILTER_VALIDATE_EMAIL)) {
    echo 'email correcte';
} else {
    echo 'email incorrecte';
}
