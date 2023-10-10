<?php
session_start();

if (isset($_SESSION['error-message']) || isset($_SESSION['register-fail'])) {
    if (
        isset($_GET["action"]) && $_GET["action"] != "" && isset($_SESSION["action"])
        && $_SESSION['action'] != $_GET["action"]
    ) {
        echo '<script>';
        echo 'console.log(' . json_encode($_GET['action'] == $_SESSION['action']) . ')';
        echo '</script>';
        session_unset();
        session_destroy();
    }
}

if (isset($_GET["action"]))
    $_SESSION['action'] = $_GET["action"];

?>
<?php
    $action = "";
    if (isset($_GET["action"]))
        $action = $_GET["action"];
    switch ($action) {
        case "inscription.php":
            include("./inscription.php");
            break;
        case "login.php":
            $_SESSION['pageAction'] = "login";
            include("./login.php");
            break;
        default:
            include("./inscription.php");
            break;
    }
    ?>