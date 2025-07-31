<?php
include_once(include_path('database/db.php'));
$dataBrand = $pdo->query("SELECT * FROM brands ORDER BY id_brand DESC ");
$dataCat = $pdo->query("SELECT * FROM categories ORDER BY id_categorie DESC ");
$dataKey = $pdo->query("SELECT * FROM keyswords ORDER BY id_keys_word DESC");
$dataStyle = $pdo->query("SELECT * FROM styles ORDER BY id_style DESC");

if (isset($_POST['action'])) {
?>
    <div class="container">
        <form class="form_box" action="<?php echo route('views/profil-admin.php?page=addProduct&action=new') ?>" method="POST"
            enctype="multipart/form-data">
            <div class="left">
                <label for="nameProduct">Nom article</label>
                <input type="text" class="nameProduct" name="nameProduct" placeholder="Name product">

                <label for="price">Prix </label>
                <input type="text" class="price" name="price" placeholder="Price">

                <?php
                while ($rowKey = $dataKey->fetch()) {
                ?>
                    <input type="checkbox" id="vehicle1" name="key" value="<?php echo $rowKey['id_keys_word'] ?>">
                    <label for="key"><?php echo $rowKey['keys_word_title'] ?></label><br>
                <?php
                }
                ?>


                <label for="description">Description</label>
                <input type="text" class="description" name="description" placeholder="Description" size="50">
            </div>
            <div class="right">
                <label for="brand">Marque</label>
                <select class="brand" name="brand">
                    <option value="unselect" selected>Marque</option>
                    <?php
                    while ($rowBrand = $dataBrand->fetch()) {
                    ?>
                        <option value="<?php echo $rowBrand['id_brand']; ?>"><?php echo $rowBrand['title_brand']; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <label for="categorie">Catégorie</label>
                <select class="categorie" name="categorie">
                    <option value="unselect" selected> Catégorie</option>
                    <?php
                    while ($rowCat = $dataCat->fetch()) {
                    ?>
                        <option value="<?php echo $rowCat['id_categorie']; ?>"><?php echo $rowCat['title_categorie']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                <label for="quantity">Quantité</label>
                <input type="number" class="quantity" name="quantity" placeholder="Quantité">

                <label id="photo">Photo</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <label for="fileToUpload">Choisissez une photo </label>
                <div id="button_box">
                    <button name="submit">Ajouter</button>
                </div>
                <?php
                while ($rowStyle = $dataStyle->fetch()) {
                ?>
                    <input type="checkbox" id="vehicle1" name="style" value="<?php echo $rowStyle['id_style'] ?>">
                    <label for="key"><?php echo $rowStyle['title_style'] ?></label><br>
                <?php
                }
                ?>
            </div>
        </form>
    </div>

<?php
} else {
    include_once(include_path('controllers/CheckAddProductController.php'));
}
