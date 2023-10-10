<?php
require_once('./database/db.php');
$dataPro = $pdo->query("SELECT * FROM styles");
if (!isset($_GET['change_style']) && !isset($_GET['delete_style']) && !isset($_GET['add_style'])) {
?>
<table style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de la style</th>
            <th>Changer</th>
            <th>Supprimer</th>
            <th><button class="verify"
                    onclick="window.location.href = './profil-admin.php?page=styleManagement&add_style=active';">Ajouter
                    une
                    style</button>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($rowPro = $dataPro->fetch()) {
        ?>
        <tr>
            <td> <?php echo $rowPro['id_style']; ?> </td>
            <td> <?php echo $rowPro['title_style']; ?> </td>
            <!--
                <td> <span><img width="100px" height="150px" src='./res/photo_product/<?php echo $rowPro['image_producte']; ?>'></span> </td>
                !-->
            <td><a
                    href="./profil-admin.php?page=styleManagement&change_style=active&id_style=<?php echo $rowPro['id_style']; ?>"><i
                        class="fa-light fa-pencil"></i></a> </td>
            <td><a
                    href="./profil-admin.php?page=styleManagement&delete_style=active&id_style=<?php echo $rowPro['id_style']; ?>"><i
                        class="fa-light fa-trash-can"></i></a> </td>
        </tr>

        <?php

        }
        ?>
    </tbody>
</table>
<?php }
else if(isset($_GET['change_style'])) {
    include_once("./back/change_style.php");
}
else if(isset($_GET['delete_style'])){
    include_once("./include_delete_style.php");
}
else if(isset($_GET['add_style'])){
    include_once("./back/add_style.php");
}