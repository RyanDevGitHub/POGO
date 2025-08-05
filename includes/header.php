<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';

?>

<header>
    <div class="head">
        <?php if (isset($_SESSION['statue']) && $_SESSION['statue'] === 'guest'): ?>
            <div style="
        background-color: #ffe8e8;
        color: #b30000;
        border: 1px solid #ffb3b3;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 500;
        margin: 20px 0;
        text-align: center;
    ">
                🛑 Pour créer une commande, vous devez avoir un compte.
                <a href="<?php echo route('index.php?action=login.php') ?>" style="color: #b30000; text-decoration: underline; font-weight: bold;">
                    Connectez-vous
                </a>
            </div>
        <?php endif; ?>

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
            <?php
            $isGuest = isset($_SESSION['statue']) && $_SESSION['statue'] === 'guest';
            $linkStyle = $isGuest ? 'pointer-events: none; opacity: 0; visibility: hidden;' : '';
            ?>
            <a
                <?php
                if (!$isGuest) {
                    if ($_SESSION['statue'] === 'client') {
                        echo 'href="' . asset('views/profil.php?modify') . '"';
                    } elseif ($_SESSION['statue'] === 'admin') {
                        echo 'href="' . asset('views/profil-admin.php') . '"';
                    }
                }
                ?>
                style="<?= $linkStyle ?>">
                <i class="fa-light fa-user"></i>
            </a>

            <a href="<?= asset('views/favoris.php') ?>" style="<?= $linkStyle ?>">
                <i class="fa-light fa-heart"></i>
            </a>

            <a href="<?= asset('views/cart.php') ?>" style="<?= $linkStyle ?>">
                <i class="fa-light fa-cart-shopping"></i>
            </a>
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