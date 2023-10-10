<form class="form_box" action="./profil-admin.php?page=styleManagement&add_style=active" method="POST"
    enctype="multipart/form-data">

    <div class="left">
        <label class="labelBrand" for="title_brand">Nom de la Style</label>
        <input class="ipText" type="text" class="title_brand" name="title_style"
            placeholder="<?php echo $title_style ?>">
        <a class="verify" name="back" href="./profil-admin.php?page=styleManagement">Retour</a>
        <?php
        if(isset($succes))
        {
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