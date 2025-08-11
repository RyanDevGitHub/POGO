    <div class="menu_container">
        <div>
            <p class="title_menu">Hommes</p>
        </div>
        <form id="produitForm" action="page-hommes.php" method="GET">

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