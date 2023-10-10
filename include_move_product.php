<div class="move_product <?php if (isset($_GET['move_product']) === true && $_GET['move_product'] === 'active') {
                            print('active');
                        } ?>">
    <h2>Modifier un Article</h2></br>

                    <?php include_once("./back/move_product.php"); ?>
                </div>
</div>