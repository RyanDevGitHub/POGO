<?php
include("./database/db.php");
$pdoStat = $pdo->prepare("SELECT pseudo,first_name,last_name,genre,style,email,mobile,adresse,code_postal,mdp,city FROM users WHERE id_user = :id");
$pdoStat->bindParam(":id", $_SESSION['id']);
$pdoStat->execute();
$result = $pdoStat->fetchAll();

if (isset($_GET['modify']) && ($_GET['modify']) !== "on") {
    $_SESSION['resulte-true'] = "";
    if ($_SESSION['resulte-true'] === false) {
        print('<script> window.alert("❌​ Vos information ne sont pas toute modifier");
</script>');
        $_SESSION['resulte-true'] = "";
    } else if ($_SESSION['resulte-true'] === true) {
        print('<script> window.alert("✔️​Toute vos information on été modifier");
    </script>');
        $_SESSION['resulte-true'] = "";
    }
}
?>

<div class="">
    <h2>Information personnelles</h2>
    <h5>Les champs marqué d'un * sont obligatoires.</h5>
    <form action="./back/move-user.php?mode=admin" name="form_profil" class="form_profil">
        <?php if (isset($_GET['note']) && $_GET['note'] == "paiement") {
            echo "<input type='hidden' name='note' value='paiement'>";
        } ?>

        <div>
            <p>Adresse e-mail de connexion*</p> <input type="email" name="email" value="<?php print($result[0]['email']); ?>" class="message-error">
            </p>
        </div>
        <div>
            <p>Adresse de livraison</p><input type="text" name="adresse" pattern="([a-zA-Z0-9àâçéèêëîïôûùüÿñæœ .-])+" title="Adresse contient charractère non accepté" value="<?php print($result[0]['adresse']); ?>">
            <p class=" message-error?>">
            </p>
        </div>
        <div>
            <p>n° téléphone</p><input type="text" name="numero" pattern="[0-9]{10}" title="Entrer un numeros français 10 chiffres" value="<?php print($result[0]['mobile']); ?>">
            <p class=" message-error?>">
        </div>
        <div>
            <p>Code Postal</p><input type="text" name="code_postal" pattern="[0-9]{5}" value="<?php print($result[0]['code_postal']); ?>">
            <p class="message-error']) ?> ">
        </div>
        <div>
            <p>Nom</p> <input type="text" name="name" value="<?php print($result[0]['last_name']); ?>">
            <p class=" message-error">
            </p>
        </div>
        <div>
            <p>Prenom</p> <input type="text" name="firstname" value="<?php print($result[0]['first_name']); ?>">
            <p class="message-error]) ?>">
            </p>
        </div>
        <div>
            <p>mot de passe </p> <input type="password" name="password">
            </p>
        </div>
        <div>
            <p>Nouveau mot de passe</p><input type="password" name="seconde_password">
            <p class="message-error"></p>
        </div>
        <div>
            <p>Pseudo</p><input type="text" name="pseudo" value="<?php print($result[0]['pseudo']); ?>">
            <p class="" message-error>
            </p>
        </div>
        <div>
            <p>Ville</p>
            <select name="city" id="ville">
                <option value="none" selected disabled hidden><?php print($result[0]['city']); ?> </option>

            </select>
        </div>
        <div>
            <input type="radio" name="gender" value="male" <?php if ($result[0]['genre'] === 'H') {
                                                                print('checked');
                                                            } ?>>Homme <input type="radio" name="gender" value="female" <?php if ($result[0]['genre'] === 'F') {
                                                                                                                            print('checked');
                                                                                                                        } ?>> Femme <p class="message-error">
            </p>
        </div>

        <!-- //////////////////////////////////// -->
        <div>
            <label class="labelProduct" for="style">Style</label>
            <select class="select" name="style">

                <?php
                include("./database/db.php");
                $data = $pdo->query("SELECT * FROM styles;");
                $style = $data->fetchAll();
                foreach ($style as $cle) {
                    if ($cle['id_style'] == $result[0]['style']) {
                ?>
                        <option value="<?php echo $cle['id_style']; ?>" selected>
                            <?php echo $cle['title_style']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $cle['id_style']; ?>"><?php echo $cle['title_style']; ?>
                        </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <!-- //////////////////////////////////// -->
        <div>
            <input type="submit" class="send" value="Modifier">
        </div>
        <?php if (isset($_GET['note']) && $_GET['note'] == "paiement") {
            echo "<div><a class='btnRetourner' href= './back/search_cart.php'>Retourner</a></div>";
        }
        ?>
        <script src="./JavaScript/profil.js"></script>
        <input hidden name="mode" value="admin">
    </form>

</div>