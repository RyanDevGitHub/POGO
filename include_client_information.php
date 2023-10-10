<div class="info-client">
    <h2>Recherche Information Clients</h2></br>
    <form class="form-search" name="form-search" action="./back/search-info-client.php">
        <div class="search">
            <input type="text" name="search-bar" autocomplete="off">
            <span id="result-search" class="result-search"></span>
        </div>
        <input type="hidden" name="info-client" value="active">
        <input type="hidden" name="container-info-client" value="active">
        <button class="search-button" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <!--
        <script>
        const search_text = document.querySelector(".text-search");
        const button_search = document.querySelector(".search-button");
        button_search.addEventListener("click", () => {
            search_text.classList.toggle("active");
        });
        </script>
    -->
    </form>
    <div class="error">
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'active') {
            echo "<font style='font-size:70%;' color = red>Aucun client avec ce pseudo trouver dans la base de donné</font><br>";
        } ?>
    </div>

    <?php
    if (isset($_GET['container-info-client']) && $_GET['container-info-client'] === 'active') {
    ?>
        <div class="container-info-client">
            <div class="menu-info-client">
                <ul>
                    <button type="button">
                        <li>Profil Client</li>
                    </button>
                    <button type="button">
                        <li>Avis Client</li>
                    </button>
                    <button type="button">
                        <li>Commande Client</li>
                    </button>
                </ul>
            </div>
            <h4><?php print($_SESSION["row"]['0']['pseudo'] . " #" . $_SESSION["row"]['0']['id_user']); ?></h4>
            <div class="profil-client">
                <table>
                    <tr>
                        <th>id</th>
                        <th>prenoms</th>
                        <th>nom</th>
                        <th>pseudo</th>
                        <th>genre</th>
                        <th>email</th>
                        <th>mobile</th>
                        <th>adresse</th>
                        <th>code_postal</th>
                        <th>status</th>
                    </tr>
                    <tr>
                        <th><?php print($_SESSION["row"]['0']['id_user']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['pseudo']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['first_name']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['last_name']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['genre']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['email']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['mobile']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['adresse']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['code_postal']); ?></th>
                        <th><?php print($_SESSION["row"]['0']['statue']); ?></th>
                        <th><a href="./profil-admin.php?page=InfosClient&info-client=active&modify-profil-client=active" class="modify-button"><i class="fa fa-cog" aria-hidden="true"></i></a></th>
                    </tr>
                </table>
            </div>
        </div>
    <?php
    } else if (isset($_GET['modify-profil-client']) && $_GET['modify-profil-client'] === 'active') {
    ?>

        <div class="modify-profil-client">
            <div class="form_profil">
                <div>
                    <p>Adresse e-mail de connexion*</p>
                    <p class="input"><?php print($_SESSION["row"]['0']['email']);  ?></p>
                </div>
                <div>
                    <p>Adresse de livraison</p>
                    <a href="./back/move-user-admin.php?input_delete=adresse" id="adresse" onclick=""><i class="fa-solid fa-eraser"></i></a>
                    <p class="input"><?php print($_SESSION["row"]['0']['adresse']); ?></p>
                </div>
                <div>
                    <p>n° téléphone</p>
                    <a href="./back/move-user-admin.php?input_delete=numero" id="numero"><i class="fa-solid fa-eraser"></i></a>
                    <p class="input"><?php print($_SESSION["row"]['0']['mobile']); ?></p>
                </div>
                <div>
                    <p>Code Postal</p>
                    <a href="./back/move-user-admin.php?input_delete=code_postal" id="code_postal"><i class="fa-solid fa-eraser"></i></a>
                    <p class="input"><?php print($_SESSION["row"]['0']['code_postal']);  ?></p>
                </div>
                <div>
                    <p>Nom</p>
                    <a href="./back/move-user-admin.php?input_delete=nom" id="nom"><i class="fa-solid fa-eraser"></i></a>
                    <p class="input"><?php print($_SESSION["row"]['0']['last_name']); ?></p>
                </div>
                <div>
                    <p>Prenom</p>
                    <a href="./back/move-user-admin.php?input_delete=prenom" id="prenom"><i class="fa-solid fa-eraser"></i></a>
                    <p class="input"><?php print($_SESSION["row"]['0']['first_name']); ?></p>
                </div>
                <div>
                    <button type="button" id="button_new_password" onclick="new_password()">Génerer un nouveau mot de
                        passe</button>
                </div>
                <div>
                    <p>Pseudo</p>
                    <p class="input"><?php print($_SESSION["row"]['0']['pseudo']) ?></p>
                </div>
                <div>
                    <a href="./profil-admin.php?page=InfosClient&info-client=active&container-info-client=active"><input type="submit" class="send" value="retour"></a>
                </div>
                <?php
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>