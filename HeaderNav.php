<?php

$url = $_SERVER['REQUEST_URI'];
$arr = explode("/", $url);
$namePage = explode(".php", $arr[array_key_last($arr)])[0];
?>
<header>
    <div class="head">
        <div class="icon">
            <div class="search">
                <form class="search form" action="./product_by_name.php" method="POST">
                    <button class="search-button" type="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div>
                        <input type="text" class="text-search" name="productName" autocomplete="off">
                        <div id="suggestions"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="logo-accueil">
            <a href="./accueil.php" class="logo"><img id="logo_pogo" src="./res/Pogo3sansfond.png" alt=""></a>
        </div>
        <div class="icon-search">
            <a <?php if ($_SESSION['statue'] === 'client') {
                    print('href="./profil.php?modify">');
                } else if ($_SESSION['statue'] === 'admin') {
                    print('href="./profil-admin.php">');
                } ?> <i class="fa-light fa-user"></i></a>
            <a href="./favoris.php"> <i class="fa-light fa-heart"></i></a>
            <a href="./carts.php"><i class="fa-light fa-cart-shopping"></i></a>
        </div>
    </div>
    <nav>
        <ul id="menuPogo">
            <a href="./page-article.php">
                <li class="<?php if ($namePage == 'page-article') echo 'active' ?>">DECOUVRIR</li>
            </a>
            <a href="./page-hommes.php">
                <li class="<?php if ($namePage == 'page-hommes') echo 'active' ?>">HOMME</li>
            </a>
            <a href="./page-femmes.php">
                <li class="<?php if ($namePage == 'page-femmes') echo 'active' ?>">FEMME</li>
            </a>
            <a href="./page-marque.php">
                <li class="<?php if ($namePage == 'page-marque') echo 'active' ?>">MARQUES</li>
            </a>
            <a href="./style-article.php">
                <li class="<?php if ($namePage == 'style-article') echo 'active' ?>">MON STYLE</li>
            </a>
        </ul>
    </nav>
    <script>
        var keywords = <?php echo json_encode($_SESSION["keyswords"]); ?>; 
        // console.log(keywords);
        // const search_text = document.querySelector(".text-search");
        // const suggestion_container = document.getElementById("suggestions");
        // const button_search = document.querySelector(".search-button");
        
        // button_search.addEventListener("click", () => {
        //     search_text.classList.toggle("active");
        //     suggestion_container.classList.toggle("active");
        // });

    </script>
    <script src="./JavaScript/auto-complete.js"> </script>
</header>