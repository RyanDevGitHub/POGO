<header>
    <img src="<?php echo asset('assets/imgs/icons/Pogo3sansfond.png') ?>" alt="">
</header>
<section>
    <div class="error-message <?php if (isset($_SESSION['register-fail'])) {
                                    print($_SESSION['register-fail']);
                                } ?>">
        <p><?php if (isset($_SESSION['error-message'])) {
                print($_SESSION['error-message']);
            } ?></p>
    </div>
    <div class="formulaire">

        <form class="form" name=form action=" <?php echo route('controllers/AuthController.php'); ?>" method="GET">
            <div class="menu-form">
                <a class="inscription active" href="index.php?action=inscription.php">Inscription</a>
                <a class="connexion">Connexion</a>
            </div>
            <div class="input-form">
                <p>Enregistrez-vous</p>
                <input type="email" name="email" placeholder="Adresse Email" required>
                <input type="password" name="mdp" placeholder="Mot de passe" minlength="4" required>
                <input type="submit" value="Se connecter">
            </div>

            <button type="button" onclick="open_modal_mot_de_passe_oublier('open')">Mot de passe oublié</button>
        </form>
        <a href="<?php echo route('controllers/AuthController.php') . '?guest=true'; ?>" class=" btn-guest-access">
            👀 Accéder en tant qu'invité
        </a>
    </div>
    <div class="modal">
        <div class="modal_mot_de_passe_oublier">
            <p>Entrer votre adresse email</p>
            <input type="email" id="email_recuperation" name="email_recuperation">
            <button type="button" onclick="send_email_de_recuperation()">Valider</button>
            <button type="button" onclick="open_modal_mot_de_passe_oublier('close')">Fermer</button>
        </div>
    </div>

</section>