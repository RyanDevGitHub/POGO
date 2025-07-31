<script>
    function myFunction(value) {
        document.getElementById("haha").value = value;
        document.getElementById("hihi").submit();
    }
</script>
<section>
    <div class="profil-section">
        <div class="navigation">
            <form id="hihi" action="profil-admin.php" method="GET">
                <input id="haha" type="hidden" name="page" value="" />
                <ul>
                    <li class="button_nav" onclick="myFunction('MonProfil')">Mon Profil</li>
                    <li class="button_nav" onclick="myFunction('InfosClient')">Information Client</li>
                    <li class="button_nav" onclick="myFunction('InfosProduit')">Information Article</li>
                    <li class="button_nav" onclick="myFunction('addProduct')">Ajouter un Article</li>
                    <li class="button_nav" onclick="myFunction('brandManagement')">Gestion des marques</li>
                    <li class="button_nav" onclick="myFunction('categorieManagement')">Gestion des catégories</li>
                    <li class="button_nav" onclick="myFunction('manageKeyWord')">Gérer les Mots Clés</li>
                    <li class="button_nav" onclick="myFunction('styleManagement')">Gestion des styles</li>
                </ul>
            </form>
            <a href=" <?php echo route('controllers/DisconnectController.php') ?>">
                <li class="">Se déconnecter</li>
            </a>

        </div>
        <!--FIN NAVIGATION-->
        <div class="information">
            <?php $compteur = 0; ?>

            <!--DEBUT CLIENT INFORMATION-->
            <?php
            if (!isset($_GET["page"])) {
                echo "<div class='mainAdmin'>
                <h2>Bienvenu au page d'admin</h2></div>";
            } else {
                if ($_GET["page"] == "MonProfil") {
                    include(include_path('includes/include_profil.php'));
                } else if ($_GET["page"] == "InfosClient") {
                    include(include_path('includes/include_client_information.php'));
                    //<!--FIN CLIENT INFORMATION-->
                } else if ($_GET["page"] == "InfosProduit") {
                    //<!-- DEBUT INFORMATION PRODUCT -->
                    echo "<div class='info_product'>
                <h2>Infomation product</h2>
                <br></br>";
                    include(include_path('includes/include_product.php'));
                    echo "</div>";
                    //<!-- FIN INFORMATION PRODUCT -->
                } else if ($_GET["page"] == "addProduct") {
                    //<!--DEBUT ADD PRODUCT-->
                    echo "<div class='info_product'>
                <h2>Ajouter un Article</h2>
                <br></br>";
                    include(include_path('includes/include_add_product.php'));
                    echo "</div>";
                    // <!--FIN ADD PRODUCT-->
                } else if ($_GET["page"] == "manageKeyWord") {
                    //<!--DEBUT ADD PRODUCT-->
                    echo "<div class='info_product'>
                <h2>Gérer les Mots Clées</h2>
                <br></br>";
                    include(include_path('includes/include_manage_keywords.php'));
                    echo "</div>";
                } else if ($_GET["page"] == "brandManagement") {
                    //<!--DEBUT ADD MARQUE-->
                    echo "<div class='info_product'>
                <h2>Gestion des marques</h2>
                <br></br>";
                    include(include_path('includes/include_brand_Management.php'));
                    echo "</div>";
                    //<!--FIN  ADD MARQUES -->
                } else if ($_GET["page"] == "categorieManagement") {
                    //<!--DEBUT ADD CATEGORIE-->
                    echo "<div class='info_product'>
                <h2>Gestion des catégories</h2>
                <br></br>";
                    include(include_path('includes/include_categorie_Management.php'));
                    echo "</div>";
                    //<!--FIN  ADD CATEGORIE -->
                } else if ($_GET["page"] == "styleManagement") {
                    //<!--DEBUT ADD STYLE-->
                    echo "<div class='info_product'>
                    <h2>Gestion des styles</h2>
                    <br></br>";
                    include(include_path('includes/include_add_style.php'));
                    echo "</div>";
                    //<!--FIN  ADD STYLE -->
                }
            }

            ?>
        </div>
    </div>
</section>

<script src="<?php
                echo asset('assets/js/' . (
                    isset($_GET['page']) ? match ($_GET['page']) {
                        'InfosClient' => 'profil-admin_info_client.js',
                        'manageKeyWord' => 'profil-admin_key_word.js',
                        default => '',
                    } : ''
                ));
                ?>"></script>