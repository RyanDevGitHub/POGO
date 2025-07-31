<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';

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
            <a href="<?php echo asset('views/accueil.php') ?>" class="logo"><img src="<?php echo asset('assets/imgs/icons/Pogo3sansfond.png')  ?>" alt=""></a>
        </div>
        <div class="icon-search">
            <a <?php if ($_SESSION['statue'] === 'client') {
                    print('href="' . asset('views/profil.php?modify') . '">');
                } else if ($_SESSION['statue'] === 'admin') {
                    print('href="' . asset('views/profil-admin.php') . '">');
                } ?> <i class="fa-light fa-user"></i></a>
            <a href=<?php echo asset('views/favoris.php') ?>> <i class="fa-light fa-heart"></i></a>
            <a href="<?php echo asset('views/cart.php') ?>"><i class="fa-light fa-cart-shopping"></i></a>
        </div>
        <script>
            var keywords = <?php echo json_encode($_SESSION["keyswords"]); ?>;
            console.log(keywords);
            // const search_text = document.querySelector(".text-search");
            // const button_search = document.querySelector(".search-button");
            // button_search.addEventListener("click", () => {
            //     search_text.classList.toggle("active");
            // });
        </script>
    </div>
</header>

<script src="<?php echo asset('assets/js/auto-complete.js') ?>"></script>