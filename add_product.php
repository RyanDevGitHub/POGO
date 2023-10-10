<form class="form_box" action="./profil-admin.php?page=addProduct&action=new&verifier=true" method="POST"
    enctype="multipart/form-data">
    <div class="left">
        <label class="labelProduct" for="nameProduct">Nom article</label>
        <input type="text" class="ipText" name="nameProduct"
            value="<?php if (!$isPosted || $isNamePro) echo $namePro; ?>">
        <?php
        if ($isPosted && !$isNamePro) {
            echo $messageNamePro;
        } else
            echo "<br><br>";
        ?>
        <label class="labelProduct" for="price">Prix </label>
        <input type="text" class="ipText" name="price" value="<?php if (!$isPosted || $isPrice) echo $price; ?>">
        <?php
        if ($isPosted && !$isPrice) {
            echo $messagePrice;
        } else
            echo "<br><br>";
        ?>
        <label class="labelProduct" for="description">Description</label>
        <input type="text" class="ipText" name="description"
            value="<?php if (!$isPosted || $isDesc) echo $description; ?>" size="50">
        <?php
        if ($isPosted && !$isDesc) {
            echo $messageDesc;
        } else
            echo "<br><br>";
        ?>

        <label class="labelProduct" for="quantity">Quantité</label>
        <input type="number" class="ipNum" name="quantity" value="<?php if (!$isPosted || $isQuant) echo $quantity; ?>"
            min="1">
        <?php
            if ($isPosted && !$isQuant){
                echo "<font style='font-size:50%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
            }
            else
                echo "<br><br>";
        ?>

        <label class="labelProduct" for="keyword">Mot Clé</label><br>
        <select class="select" id="optionSelect">
            <?php
            foreach($key as $cle){
            ?>
            <option value=<?php echo $cle['keys_word_title']; ?>><?php echo $cle['keys_word_title']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="hidden" id="ipKeyWord" name="keyword" value="<?php if (!$isPosted || $isKey) echo $keyword; ?>">

        <?php
        if ($isPosted && !$isKey) {
            echo $messageKey;
        } 
        ?>
        <div class="linkAdd">
            <a class="link" href="profil-admin.php?page=manageKeyWord">Ajouter un mot clé</a><br>
        </div>
        <div>
            <button id="addKeyWord" class="addBtn" type="button">Ajouter la clé pour produit</button>
        </div>
        <div id="listKey"></div>
        <script src="./JavaScript/add_product.js?v=3"></script>
    </div>

    <div class="right">
        <label class="labelProduct" for="brand">Marque</label>
        <select class="select" name="brand">
            <?php
            foreach ($brand as $cle) {
            ?>
            <option value="<?php echo $cle['id_brand']; ?>"><?php echo $cle['title_brand']; ?></option>
            <?php
            }
            ?>
        </select>

        <div class="linkAdd">
            <a class="link" href="./profil-admin.php?page=brandManagement">Ajouter un marque</a>
        </div>
        <label class="labelProduct" for="categorie">Catégorie</label>
        <select class="select" name="categorie">
            <?php
            foreach ($categorie as $cle) {
            ?>
            <option value="<?php echo $cle['id_categorie']; ?>"><?php echo $cle['title_categorie']; ?></option>
            <?php
            }
            ?>
        </select>
        <div class="linkAdd">
            <a class="link" href="profil-admin.php?page=categorieManagement">Ajouter un catégorie</a><br>
        </div>

        <label class="labelProduct" id="photo">Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" /><br>
        <?php             
            if ($isPosted && !$isPhoto){
                echo $messagePhoto;
                echo "<br>";
            }
            else
                echo "<br><br>";
            ?>

        <!-- /////////////////////////////////////////////// -->

        <label class="labelProduct" for="style">Style</label><br>
        <select class="select" id="optionSelectStyle">
            <?php
            foreach($styleList as $cle){
            ?>
            <option value=<?php echo $cle['title_style']; ?>><?php echo $cle['title_style']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="hidden" id="ipStyle" name="style" value="<?php ?>">

        <?php
        if ($isPosted && !$isStyle) {
            echo $messageStyle;
        } 
        ?>
        <div class="linkAdd">
            <a class="link" href="profil-admin.php?page=styleManagement">Ajouter un style</a><br>
        </div>
        <div>
            <button id="addStyle" class="addBtn" type="button">Ajouter la style pour produit</button>
        </div>
        <div id="listStyle"></div>
        <script src="./JavaScript/add_style.js?v=3"></script>

        <!-- /////////////////////////////////// -->
        <div id="button_box">
            <button class="verify" name="submit">Ajouter</button>
        </div>

    </div>
</form>