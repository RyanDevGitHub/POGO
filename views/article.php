<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
if (!$_SESSION['statue'])
    redirect("index.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.They is POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/article.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/base.css') ?>">
</head>

<?php
include(include_path('includes/headerNav.php'));
require_once(include_path('database/db.php'));
$dataPro = $pdo->query("SELECT * FROM categories");
$dataBrands = $pdo->query("SELECT * FROM brands");

$brandProduit = isset($_GET["brand"]) ? $_GET["brand"] : '';
$priceProduit = isset($_GET["price"]) ? $_GET["price"] : '';
$categoryProduit = isset($_GET["category"]) ? $_GET["category"] : '';

?>
<div class="article_section">
    <?php include_once(include_path('includes/menu_container.php')); ?>
    <div class="article-container">
        <?php

        include_once(include_path('database/db.php'));
        $arrConditions = ["1"];
        if (!empty($brandProduit) || !empty($priceProduit) || !empty($categoryProduit)) {
            if (!empty($brandProduit)) {
                $condition = $brandProduit == 'all' ? '1' :  "`brand_producte` = $brandProduit ";
                array_push($arrConditions, $condition);
            }
            if (!empty($priceProduit)) {
                if ($priceProduit == 'all') {
                    $condition = '1';
                } else if ($priceProduit == "under_20") {
                    $condition = "`price_producte` < 20";
                } else if ($priceProduit == "between_20and50") {
                    $condition = "(`price_producte` BETWEEN 20 AND 50)";
                } else if ($priceProduit == "above_50") {
                    $condition = "`price_producte` > 50";
                };
                array_push($arrConditions, $condition);
            }
            if (!empty($categoryProduit)) {
                $condition = $categoryProduit == 'all' ? '1' : "`cat_producte` = '$categoryProduit'";
                array_push($arrConditions, $condition);
            }
        }
        $allConditions = implode(" AND ", $arrConditions);
        $data = $pdo->query("SELECT * FROM productes WHERE $allConditions  ORDER BY id_producte ASC");

        while ($rowPro = $data->fetch()) {
            $pdostat = $pdo->prepare("SELECT ROUND(AVG(note_avis))
            FROM avis
            WHERE product_id = :product_id");
            $pdostat->bindParam(":product_id", $rowPro["id_producte"]);
            $pdostat->execute();
            $row = $pdostat->fetch();

        ?>
            <a href="<?php echo route('views/article-zoom.php?id_product=') ?><?php echo $rowPro['id_producte']; ?>">
                <div class="article">
                    <img class=img-article src="<?php echo asset('assets/imgs/img-products/') ?><?php echo $rowPro['image_producte']; ?>" alt="">
                    <p class="title_article"><?php echo $rowPro['title_producte']; ?></p>
                    <p class="prix_article"><?php echo $rowPro['price_producte']; ?> €</p>
                    <div class="note-stock">
                        <img class="note_article" <?php echo asset('assets/imgs/rating-stars/') ?><?php print($row[0]); ?>STARS.png" alt="">
                        <p class="stock_article"><?php if (intval($rowPro['quantity_producte'] > 0)) {
                                                    } else {
                                                        echo "épuisé";
                                                    }
                                                    ?></p>
                    </div>
                </div>
            </a>
        <?php
        }


        ?>
    </div>


</div>
<?php
include(include_path('includes/reseaux.php'));
?>

<?php
include(include_path('includes/footer.php'));
?>
<script>
    function filterBrand(value) {
        let isChecked = document.getElementById("brand_" + value).checked;
        let newValue = isChecked ? value : '';
        document.getElementById("brandProduit").value = newValue;
        document.getElementById("produitForm").submit();
    }

    function filterPrice(value) {
        let isChecked = document.getElementById("price_" + value).checked;
        console.log(isChecked);
        let newValue = isChecked ? value : '';
        document.getElementById("priceProduit").value = newValue;
        document.getElementById("produitForm").submit();
    }

    function filterCategory(value) {
        let isChecked = document.getElementById("category_" + value).checked;
        let newValue = isChecked ? value : '';
        document.getElementById("categoryProduit").value = newValue;
        document.getElementById("produitForm").submit();
    }
</script>
<script src="<?php echo asset('assets/js/accueil.js') ?>"> </script>