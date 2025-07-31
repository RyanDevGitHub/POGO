<?php

$url = $_SERVER['REQUEST_URI'];
$arr = explode("/", $url);
$namePage = explode(".php", $arr[array_key_last($arr)])[0];
?>
<header>
    <div class="head">
        <div class="icon">
            <div class="search">
                <form class="custom-search-form" action="<?php echo route('views/product_by_name.php') ?>" method="POST">
                    <input type="search" class="custom-search-input" name="productName" autofocus autocomplete="off" required>
                    <i class="fa fa-search"></i>
                    <div id="custom-suggestions"></div>
                </form>
            </div>
        </div>
        <div class="logo-accueil">
            <a href="<?php echo asset('views/accueil.php') ?>" class="logo"><img id="logo_pogo" src="<?php echo asset('assets/imgs/icons/Pogo3sansfond.png') ?>" alt=""></a>
        </div>
        <div class="icon-search">
            <a <?php if ($_SESSION['statue'] === 'client') {
                    print('href="' . asset('views/profil.php?modify') . '">');
                } else if ($_SESSION['statue'] === 'admin') {
                    print('href="' . asset('views/profil-admin.php') . '">');
                } ?> <i class="fa-light fa-user"></i></a>
            <a href="<?php echo route('views/favoris.php') ?>"> <i class="fa-light fa-heart"></i></a>
            <a href="<?php echo route('views/carts.php') ?>"><i class="fa-light fa-cart-shopping"></i></a>
        </div>
    </div>
    <nav>
        <ul id="menuPogo">
            <a href="<?php echo asset('views/article.php') ?>">
                <li class="<?php if ($namePage == 'article') echo 'active' ?>">DECOUVRIR</li>
            </a>
            <a href="<?php echo asset('views/hommes.php') ?>">
                <li class="<?php if ($namePage == 'hommes') echo 'active' ?>">HOMME</li>
            </a>
            <a href="<?php echo asset('views/femmes.php') ?>">
                <li class="<?php if ($namePage == 'femmes') echo 'active' ?>">FEMME</li>
            </a>
            <a href="<?php echo asset('views/marque.php') ?>">
                <li class="<?php if ($namePage == 'marque') echo 'active' ?>">MARQUES</li>
            </a>
            <a href="<?php echo asset('views/style-article.php') ?>">
                <li class="<?php if ($namePage == 'style-article') echo 'active' ?>">MON STYLE</li>
            </a>
        </ul>
    </nav>
    <script>
        var keywords = <?php echo json_encode($_SESSION["keyswords"]); ?>;
        console.log(keywords);
        // const search_text = document.querySelector(".text-search");
        // const suggestion_container = document.getElementById("suggestions");
        // const button_search = document.querySelector(".search-button");

        // button_search.addEventListener("click", () => {
        //     search_text.classList.toggle("active");
        //     suggestion_container.classList.toggle("active");
        // });
    </script>
    <script src="<?php echo asset('assets/js/auto-complete.js') ?>"> </script>
</header>