<?php
if(isset($_POST['delete_option'])){
    if($_POST['delete_option'] === "non"){
        header("Location: ./profil-admin.php?page=brandManagement");
    }
    else{
        include_once("./back/delete_brand.php");
    }
   
}
else{
    ?>
    <form action="./profil-admin.php?page=brandManagement&delete_brand=active&id_brand=<?php echo $_GET['id_brand'] ?>" method="POST">
    <label>Voulez vous supprimer cette marque ?</label>
    <select name="delete_option" id="cars">
        <option value="oui">Oui</option>
        <option value="non">Non</option>
    </select>
    <div id="button_box">
        <button class="verify" name="submit">Valider</button>
    </div>
    </form>
    <?php
}
