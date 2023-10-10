<?php
session_start();
if (!$_SESSION['statue'])
  header("Location: ./index.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.They is POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/page-article.css?v=1">
</head>

<?php
include("./HeaderNav.php");
require_once('./database/db.php');

$dataBrands = $pdo->query("SELECT * FROM brands ORDER BY title_brand ASC");

?>
<div class="brands_container">
    <div class="mainBrands">
        <div>
            <h1>LES MARQUES DE A À Z</h1>
        </div>
        <ul class="brandBlock">
            <?php
    while ($rowBrand = $dataBrands->fetch()) {
    ?>
            <li class="brand">
                <a href="./page-article.php?brand=<?php echo $rowBrand['id_brand']; ?>">
                    <span class="title_brand"><?php echo $rowBrand['title_brand']; ?></span>
                </a>

            </li>

            <?php
    }
    ?>
        </ul>

    </div>
</div>
<?php
include("./reseaux.php");
?>

<?php
include("./footer.php");
?>
<script>
function myFunction(value) {
    document.getElementById("haha").value = value;
    document.getElementById("hihi").submit();
}
</script>
<script src="./JavaScript/accueil.js"></script>