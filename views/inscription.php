<header>
    <img src="<?php echo asset('assets/imgs/icons/Pogo3sansfond.png') ?>" alt="">
</header>
<section>
    <div class="error-message <?php if (isset($_SESSION['register-fail'])) print($_SESSION['register-fail']); ?>">
        <p><?php if (isset($_SESSION['error-message'])) print($_SESSION['error-message']); ?> </p>
    </div>
    <div class="formulaire">
        <form class="form" name="form-register" action="<?php echo route('controllers/RegisterController.php') ?>" method="GET">
            <div class="menu-form">
                <a class="inscription">Inscription</a>
                <a class="connexion active" href="<?php echo route('index.php?action=login.php') ?>">Connexion</a>
            </div>
            <div class="input-form">
                <p>Inscription</p>
                <input type="text" name="pseudo" placeholder="Pseudo" minlength="2" required value="<?php if (isset($_SESSION["pseudo"])) print($_SESSION["pseudo"]); ?>">
                <input type="email" name="email" placeholder="Adresse Email" required value="<?php if (isset($_SESSION["email"])) print($_SESSION["email"]); ?>">
                <input type="password" name="mdp" placeholder="Mot de passe" minlength="4" required value="">
                <input type="password" name="verefmdp" placeholder="Confirmation Mot de passe" required value="">

                <div class="checkbox">
                    <input name=checkbox value="1" type="checkbox" required>
                    <p>Je comfirme d'être âgé.e d'au moins 18 ans</p>
                </div>
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </div>
</section>