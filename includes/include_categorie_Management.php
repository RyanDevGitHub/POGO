<?php
require_once(include_path('database/db.php'));
$dataPro = $pdo->query("SELECT * FROM categories");
if (!isset($_GET['change_categorie']) && !isset($_GET['delete_categorie']) && !isset($_GET['add_categorie'])) {
?>
    <table style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la catégorie</th>
                <th>Changer</th>
                <th>Supprimer</th>
                <th><button class="verify" onclick="window.location.href = '<?php echo route('views/profil-admin.php?page=categorieManagement&add_categorie=active') ?>';">Ajouter une catégorie</button>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($rowPro = $dataPro->fetch()) {
            ?>
                <tr>
                    <td> <?php echo $rowPro['id_categorie']; ?> </td>
                    <td> <?php echo $rowPro['title_categorie']; ?> </td>
                    <!--
                <td> <span><img width="100px" height="150px" src='<?php echo asset('assets/imgs/img-products/') ?><?php echo $rowPro['image_producte']; ?>'></span> </td>
                !-->
                    <td><a href="<?php echo route('views/profil-admin.php?page=categorieManagement&change_categorie=active&id_categorie=') ?><?php echo $rowPro['id_categorie']; ?>"><i class="fa-light fa-pencil"></i></a> </td>
                    <td><a href="<?php echo route('views/profil-admin.php?page=categorieManagement&delete_categorie=active&id_categorie=') ?><?php echo $rowPro['id_categorie']; ?>"><i class="fa-light fa-trash-can"></i></a> </td>
                </tr>

            <?php

            }
            ?>
        </tbody>
    </table>
<?php } else if (isset($_GET['change_categorie'])) {
    include_once(include_path('controllers/ChangeCategorieController.php'));
} else if (isset($_GET['delete_categorie'])) {
    include_once(include_path('includes/include_delete_categorie.php'));
} else if (isset($_GET['add_categorie'])) {
    include_once(include_path('controllers/AddCategorieController.php'));
}
