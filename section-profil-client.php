<?php

//GET DATA TO INTER IN FORM
include("./database/db.php");
$pdoStat = $pdo->prepare("SELECT pseudo,first_name,last_name,genre,style,email,mobile,adresse,code_postal,mdp,city FROM users WHERE id_user = :id");
$pdoStat->bindParam(":id", $_SESSION['id']);
$pdoStat->execute();
$result = $pdoStat->fetchAll();

if (($_GET['modify']) !== "on") {
    $_SESSION['resulte-true'] = "";
}


if ($_SESSION['resulte-true'] === false) {
    print('<script> window.alert("❌​ Vos information ne sont pas toute modifier");
</script>');
    $_SESSION['resulte-true'] = "";
} else if ($_SESSION['resulte-true'] === true) {
    print('<script> window.alert("✔️​Toute vos information on été modifier");
    </script>');
    $_SESSION['resulte-true'] = "";
}

?>



<!--DEBUT SECTION-->
<section>
    <div class="profil-section">
        <!--DEBUT NAVIGATION-->
        <div class="navigation">
            <form id="profileSectionForm" action="profil.php" method="GET">
                <input id="profileSection" type="hidden" name="sectionProfile" value="" />
                <ul>
                    <li class="buttun_mon_compte" onclick="selectProfileSection('myAccount')">Mon compte</li>
                    <li class="buttun_historique_de_commande" onclick="selectProfileSection('historyCommand')">
                        Historique de commande
                    </li>
                    <li class="buttun_marques_favorites" onclick="selectProfileSection('favoriteBrands')">Marques
                        favorites</li>
                    <li><a href="./back/disconnect.php">Se déconnecter</a></li>
                    <!-- <a href="#" onclick="addClassMonCompte()">
                        <li class="buttun_mon_compte">Mon compte</li>
                    </a>
                    <a href="#" onclick="addClassHistoriqueDeCommandes()">
                        <li class="buttun_historique_de_commande">Historique de commande</li>
                    </a>
                    <a href="#" onclick="addClassMarquesFavorites()">
                        <li class="buttun_marques_favorites">Marques favorites</li>
                    </a>
                    <a href="./back/disconnect.php">
                        <li class="">Se déconnecter</li>
                    </a> -->
                </ul>
            </form>

        </div>
        <!--FIN NAVIGATION-->
        <div class="information">
            <?php
            if (!isset($_GET["sectionProfile"])) {
                echo "<div class='mainClient'>
                    <h2>Bienvenu au page de client</h2></div>";
            } else if ($_GET["sectionProfile"] == "myAccount") {
                include('./include_section_client_infos.php');
            } else if ($_GET["sectionProfile"] == "historyCommand") {
                include('./include_section_history_command.php');
            } else  if ($_GET["sectionProfile"] == "favoriteBrands") {
                include('./include_section_favorite_brands.php');
            } else  if ($_GET["sectionProfile"] == "historyCommandDetail") {
                include('./include_section_history_command_detail.php');
            }
            ?>
        </div>
    </div>
</section>

<script>
    function selectProfileSection(section) {
        document.getElementById('profileSection').value = section;
        document.getElementById('profileSectionForm').submit();
    }
</script>
<script src="./JavaScript/profil.js"></script>
<script src="./JavaScript/auto-complete.js"></script>