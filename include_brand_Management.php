<?php
require_once('./database/db.php');
$dataPro = $pdo->query("SELECT * FROM brands");
if (!isset($_GET['change_brand']) && !isset($_GET['delete_brand']) && !isset($_GET['add_brand'])) {
?>
<table style="width:100%">
  <thead>
      <tr>
          <th>ID</th>
          <th>Nom de la marque</th>
          <th>Changer</th>
          <th>Supprimer</th>
          <th><button class="verify" onclick="window.location.href = './profil-admin.php?page=brandManagement&add_brand=active';">Ajouter une marque</button>
</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($rowPro = $dataPro->fetch()) {
        ?>
            <tr>
                <td> <?php echo $rowPro['id_brand']; ?> </td>
                <td> <?php echo $rowPro['title_brand']; ?> </td>
                <!--
                <td> <span><img width="100px" height="150px" src='./res/photo_product/<?php echo $rowPro['image_producte']; ?>'></span> </td>
                !-->
                <td><a href="./profil-admin.php?page=brandManagement&change_brand=active&id_brand=<?php echo $rowPro['id_brand']; ?>"><i class="fa-light fa-pencil"></i></a> </td>
                <td><a href="./profil-admin.php?page=brandManagement&delete_brand=active&id_brand=<?php echo $rowPro['id_brand']; ?>"><i class="fa-light fa-trash-can"></i></a> </td>
            </tr>

        <?php

        }
        ?>
    </tbody>
</table>
<?php }
else if(isset($_GET['change_brand'])) {
    include_once("./back/change_brand.php");
}
else if(isset($_GET['delete_brand'])){
    include_once("./include_delete_brand.php");
}
else if(isset($_GET['add_brand'])){
    include_once("./back/add_brand.php");
}
