<?php
if(!isset($_POST['delete_option'])){
    ?>
<form action="./profil-admin.php?page=styleManagement&delete_style=active&id_style=<?php echo $_GET['id_style'] ?>"
    method="POST">
    <label>Voulez vous supprimer cette style ?</label>
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
else{
    if($_POST['delete_option'] === "non"){
        header("Location: ./profil-admin.php?page=styleManagement");
    }
    else{
        include_once("./back/delete_style.php");
    }
}