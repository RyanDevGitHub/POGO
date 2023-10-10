<form class="form_box"
    action="./profil-admin.php?page=styleManagement&change_style=active&id_style=<?php echo $_GET['id_style']?>"
    method="POST" enctype="multipart/form-data">

    <div class="formChangeStyle">
        <label class=" labelBrand" for="title_brand">Nom de la Style</label>
        <input class="ipText" type="text" class="title_brand" name="title_style"
            placeholder="<?php echo $title_style ?>">
        <span class="errMsg"><?php
        if(isset($succes))
        {
            echo $succes;
        }
        ?></span>
    </div>

    <div class="buttonZone">
        <a class="verify" name="back" href="./profil-admin.php?page=styleManagement">Retour</a>
        <button class="verify" name="submit">Modifier</button>
    </div>
</form>