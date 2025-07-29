<?php
require_once 'back/include/function.php';
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
            <a href="/accueil.php" class="logo"><img src="<?php echo asset('res/Pogo3sansfond.png')  ?>" alt=""></a>
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