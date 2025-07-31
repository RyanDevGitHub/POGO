<form class="form_box"
    action="<?php echo route('views/profil-admin.php?page=brandManagement&change_brand=active&id_brand=') ?><?php echo $_GET['id_brand'] ?>"
    method="POST" enctype="multipart/form-data">

    <div class="formChangeStyle">
        <label class="labelBrand" for="title_brand">Nom de la marque</label>
        <input class="ipText" type="text" class="title_brand" name="title_brand"
            placeholder="<?php echo $title_brand ?>">
        <span class="errMsg"><?php
                                if (isset($succes)) {
                                    echo $succes;
                                }
                                ?></span>
    </div>

    <div class="buttonZone">
        <a class="verify" name="back" href="<?php echo route('views/profil-admin.php?page=brandManagement') ?>">Retour</a>
        <button class="verify" name="submit">Modifier</button>
    </div>

</form>