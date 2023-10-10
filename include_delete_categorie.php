<?php
if(isset($_POST['delete_option'])){
    if($_POST['delete_option'] === "non"){
        header("Location: ./profil-admin.php?page=categorieManagement");
    }
    else{
        include_once("./back/delete_categorie.php");
    }
  
}
else{
    ?>
    <form action="./profil-admin.php?page=categorieManagement&delete_categorie=active&id_categorie=<?php echo $_GET['id_categorie'] ?>" method="POST">
    <label>Voulez vous supprimer cette catégorie ?</label>
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
