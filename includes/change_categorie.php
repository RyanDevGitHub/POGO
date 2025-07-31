<form class="form_box"
    action="<?php echo route('views/profil-admin.php?page=categorieManagement&change_categorie=active&id_categorie=') ?><?php echo $_GET['id_categorie'] ?>"
    method="POST" enctype="multipart/form-data">

    <div class="formChangeStyle">
        <label class="labelcategorie" for="title_categorie">Nom de la catégorie</label>
        <input class="ipText" type="text" class="title_categorie" name="title_categorie"
            placeholder="<?php echo $title_categorie ?>">
        <span class="errMsg"><?php
                                if (isset($succes)) {
                                    echo $succes;
                                }
                                ?></span>
    </div>

    <div class="buttonZone">
        <a class="verify" name="back" href="<?php echo route('views/profil-admin.php?page=categorieManagement') ?>">Retour</a>
        <button class="verify" name="submit">Modifier</button>
    </div>

</form>