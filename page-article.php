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
    <link rel="stylesheet" href="./css/page-article.css?v=2">
</head>

<?php
include("./HeaderNav.php");
require_once('./database/db.php');
$dataPro = $pdo->query("SELECT * FROM categories");
$dataBrands = $pdo->query("SELECT * FROM brands");

$brandProduit = isset($_GET["brand"]) ? $_GET["brand"] : '';
$priceProduit = isset($_GET["price"]) ? $_GET["price"] : '';
$categoryProduit = isset($_GET["category"]) ? $_GET["category"] : '';

?>
<div class="article_section">
    <div class="menu_container">
        <div>
            <p class="title_menu">Filtre</p>
        </div>
        <form id="produitForm" action="page-article.php" method="GET">

            <div>
                <p class="title_menu">Marque</p>
            </div>
            <input id="brandProduit" type="hidden" name="brand" value="<?php echo $brandProduit  ?>" />
            <ul>
                <li class="labelFilter">
                    <input type="checkbox" id="brand_all" onclick="filterBrand('all')" <?php if ($brandProduit == "all") echo "checked"; ?> /> All
                </li>

                <?php
                while ($row = $dataBrands->fetch()) {
                ?>
                    <li class="labelFilter">
                        <input type="checkbox" id="brand_<?php echo $row['id_brand']; ?>" onclick="filterBrand('<?php echo $row['id_brand']; ?>')" <?php if ($brandProduit ==  $row['id_brand']) echo "checked"; ?> />
                        <?php echo $row['title_brand']; ?>
                    </li>
                <?php

                }
                ?>
            </ul>
            <div>
                <p class="title_menu">Gamme de prix</p>
            </div>
            <input id="priceProduit" type="hidden" name="price" value="<?php echo $priceProduit  ?>" />
            <ul>
                <li class="labelFilter"> <input type="checkbox" id="price_all" onclick="filterPrice('all')" <?php if ($priceProduit == "all") echo "checked"; ?> /> All </li>
                <li class="labelFilter"> <input type="checkbox" id="price_under_20" onclick="filterPrice('under_20')" <?php if ($priceProduit == "under_20") echo "checked"; ?> />
                    < 20 euro </li>
                <li class="labelFilter"> <input type="checkbox" id="price_between_20and50" onclick="filterPrice('between_20and50')" <?php if ($priceProduit == "between_20and50") echo "checked"; ?> /> 20 - 50 euro </li>
                <li class="labelFilter"><input type="checkbox" id="price_above_50" onclick="filterPrice('above_50')" <?php if ($priceProduit == "above_50") echo "checked"; ?> /> > 50 euro </li>
            </ul>
            <div>
                <p class="title_menu">Catégorie</p>
            </div>
            <input id="categoryProduit" type="hidden" name="category" value="<?php echo $categoryProduit  ?>" />
            <ul>
                <li class="labelFilter"> <input type="checkbox" id="category_all" onclick="filterCategory('all')" <?php if ($categoryProduit == "all") echo "checked"; ?> /> All</li>
                <?php
                while ($row = $dataPro->fetch()) {
                ?>

                    <li class="labelFilter">
                        <input type="checkbox" id="category_<?php echo $row['id_categorie']; ?>" onclick="filterCategory('<?php echo $row['id_categorie']; ?>')" <?php if ($categoryProduit == $row['id_categorie']) echo "checked"; ?> />
                        <?php echo $row['title_categorie']; ?>

                    </li>
                <?php

                }
                ?>
            </ul>
        </form>


    </div>
    <div class="article_container">
        <?php

        include_once("./database/db.php");
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
            <a href="./page-article-zoom.php?id_product=<?php echo $rowPro['id_producte']; ?>">
                <div class="article">
                    <img class=img_article src="./res/photo_product/<?php echo $rowPro['image_producte']; ?>" alt="">
                    <p class="title_article"><?php echo $rowPro['title_producte']; ?></p>
                    <p class="prix_article"><?php echo $rowPro['price_producte']; ?> €</p>
                    <div class="note-stock">
                        <img class="note_article" src="./res/note_producte/<?php print($row[0]); ?> STARS.png" alt="">
                        <p class="stock_article"><?php if (intval($rowPro['quantity_producte'] > 0)) {
                                                        echo $rowPro['quantity_producte'];
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
include("./reseaux.php");
?>

<?php
include("./footer.php");
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
<script src="./JavaScript/accueil.js"></script>