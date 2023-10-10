<?php
include("./database/db.php");
$pdoStat = $pdo->prepare("SELECT * FROM keyswords");
$pdoStat->execute();
$keyarray = $pdoStat->fetchAll();
//var_dump($_SESSION);
if (isset($_SESSION['error']) && $_SESSION['error'] == "on") {
    echo '<script>
    alert("👎​Votre Mot Clé n\'a pas été ajouter 😡​ \n Votre Mot Clé doit contenir uniquement des lettre entre 2 char et 25 char  Ou votre mots clé existe déja ");
    </script>';
    $_SESSION['error'] = "";
} else if (isset($_SESSION['error']) && $_SESSION['error'] == "off") {
    echo '<script>
    alert("👌​Votre Mot Clé a été ajouter ✔️​ ");
    </script>';
    $_SESSION['error'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="response_delete_key_word"></div>
    <div class="container_key_word">
        <form action="./back/add_keywords.php" class="manage-keys-words">
            <p> Ajouter un Mots Clé</p>
            <input type="text" name="name_new_key_word">
            <input class="verify" type="submit" value="OK">
        </form>
        <div class="modify_keyword">
            <div>
                <p></br>Modifier un Mots Clé</p>
                <select id="keyword" id="">
                    <option value="none" selected disabled hidden>Selectioner un Mot clé à modifier</option>
                    <?php
                    foreach ($keyarray as $key => $value) {
                        print("<option value='" . $value['keys_word_title'] . "'id='" . ($value["id_keys_word"]) . "'>" . $value["keys_word_title"] . "</option>");
                    }
                    ?>
                </select>
            </div>
            <div class="edit-key-word">

                <p>Nouvelle valeur</p><input type="text" name="new_name_key_word">
                <button type="button" class="verify" id="move_key_word">MODIFIER</button>
                <input type="submit" class="verify" id="delete_key_word" value="SUPRIMER">
                </form>
            </div>
        </div>

    </div>
</body>

</html>