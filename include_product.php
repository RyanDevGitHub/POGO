<?php
require_once('./database/db.php');
$dataPro = $pdo->query("SELECT * FROM productes INNER JOIN brands ON brands.id_brand = productes.brand_producte");
if (!isset($_GET['move_product']) && !isset($_GET['delete_product'])) { ?>
<table style="width:100%">
    <thead>
        <tr>
            <th>ID article</th>
            <th>Nom article</th>
            <th>Image article</th>
            <th>Prix</th>
            <th>Marque</th>
            <th>Changer</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($rowPro = $dataPro->fetch()) {
            ?>
        <tr>
            <td> <?php echo $rowPro['id_producte']; ?> </td>
            <td> <?php echo $rowPro['title_producte']; ?> </td>
            <td> <span><img width="100px" height="150px"
                        src='./res/photo_product/<?php echo $rowPro['image_producte']; ?>'></span> </td>
            <td> <?php echo $rowPro['price_producte']; ?> € </td>
            <td> <?php echo $rowPro['title_brand']; ?> </td>
            <td><a
                    href="./profil-admin.php?page=InfosProduit&move_product=active&id_producte=<?php echo $rowPro['id_producte']; ?>&brand=<?php echo $rowPro['title_brand']; ?>"><i
                        class="fa-light fa-pencil"></i></a> </td>
            <td><a
                    href="./profil-admin.php?page=InfosProduit&delete_product=active&id_producte=<?php echo $rowPro['id_producte']; ?>"><i
                        class="fa-light fa-trash-can"></i></a> </td>
        </tr>
        <?php
            }
            ?>
    </tbody>
</table>
<?php } else if (isset($_GET['move_product'])) {
    include_once("./back/move_product.php");
} else if (isset($_GET['delete_product'])) {
    include_once("./include_delete_product.php");
}