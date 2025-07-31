<form class="form_box" action="<?php echo route('views/profil-admin.php?page=categorieManagement&add_categorie=active') ?>" method="POST" enctype="multipart/form-data">

    <div class="left">
        <label class="labelcategorie" for="title_categorie">Nom de la catégorie</label>
        <input class="ipText" type="text" class="title_categorie" name="title_categorie" placeholder="<?php echo $title_categorie ?>">
        <a class="verify" name="back" href="<?php echo route('views/profil-admin.php?page=categorieManagement') ?>">Retour</a>
        <?php
        if (isset($succes)) {
            echo $succes;
        }
        ?>
    </div>

    <div class="right">

        <div id="button_box">
            <button class="verify" name="submit">Ajouter</button>
        </div>
    </div>

</form>