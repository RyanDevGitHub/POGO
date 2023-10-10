<?php
session_start();
if (!$_SESSION['statue'])
  header("Location: ./index.php");
?>
++
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

$productQuiz = $pdo->query("SELECT producte_id FROM productes INNER JOIN styles_productes ON productes.id_producte LIKE styles_productes.producte_id ASC ");

$productQuiz = $productQuiz->fetch(PDO::FETCH_BOTH);


$nameQuiz = $pdo->query("SELECT title_producte FROM productes INNER JOIN styles_productes ON productes.id_producte LIKE styles_productes.producte_id ASC ");

$nameQuiz = $nameQuiz->fetch(PDO::FETCH_BOTH);


$result = $pdo->query("SELECT DISTINCT COUNT(*) FROM productes INNER JOIN styles_productes ON productes.id_producte LIKE styles_productes.producte_id ASC ");
$max = $result->fetch();
$max = $max[0];
print_r($productQuiz);
echo $productQuiz[0];
echo $nameQuiz[0];
?>
<div class="brands_container">
  <?php $random = random_int(0, $max);
  $random = 3;?>
    <a href="./page-article-zoom.php?id_product=<?php echo $productQuiz[0] ?>">
      <div class="brand">
        <p class="title_brand"><?php echo $nameQuiz[0] ?></p>
      </div>

    </a>
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
