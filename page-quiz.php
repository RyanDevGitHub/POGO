<?php
session_start();
if (!$_SESSION['statue'])
    header("Location: ./index.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.They is POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="./css/page_style.css">
</head>
<?php
include("./HeaderNav.php");
require_once('./database/db.php');

$data = $pdo->query("SELECT *
FROM styles");
?>
<div class="article_container">
    <?php
    while ($rowStyle = $data->fetch()) {
    ?>

        <div class="article">
            <form class="form_box" action="./back/page-quiz.php" method="POST" enctype="multipart/form-data">
                <img class=img_article src="./res/<?php echo "style" . $rowStyle['id_style'] . ".png"; ?>" alt="">

                <input class="ipText" type="hidden" class="id_style" name="id_style" value="<?php echo $rowStyle['id_style'] ?>">

                <div id="button_box">
                    <button class="verify" name="submit"><?php echo "Le style " . $rowStyle['title_style']; ?></button>
                </div>
        </div>

        </form>

    <?php
    }


    ?>
</div>
</head>
<?php
include("./reseaux.php");
?>


<?php
include("./footer.php");
?>
<script>
    function myFunction(value) {
        document.getElementById("haha").value = value;
        document.getElementById("hihi").submit();
    }
</script>
<script src="./JavaScript/accueil.js"></script>