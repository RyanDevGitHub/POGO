<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
$_SESSION["id_product"] = $_GET["id_product"];
if (isset($_SESSION["avis"]) && $_SESSION["avis"] === "fail") {
    print('<script> window.alert("❌​ Vous avez deja fait un avis sur cette article ❌");
    </script>');
    unset($_SESSION["avis"]);
} elseif (isset($_SESSION["avis"]) && $_SESSION["avis"] === "good") {
    print('<script> window.alert("✔️​​ Votre avis à été ajouter  ✔️​");
    </script>');
    unset($_SESSION["avis"]);
}
?>

<!--HEAD-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogo.Ici c'est POGO.</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link rel="stylesheet" href="<?php echo asset('assets/css/article-zoom.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/base.css') ?>">

</head>
<!-- fin HEAD-->

<?php
include(include_path('includes/headerNav.php'));
include(include_path('controllers/SearchProductController.php'));
?>
<section>
    <div class=" article-zoom">
        <div class="img-product">
            <div class="img">
                <img width="200px" height="350px" src="<?php echo asset('assets/imgs/img-products/') . $imagePro; ?>" alt="">
            </div>
            <div class="galerie-button">
                <button>VOIR LA GALERIE</button>
            </div>
        </div>

        <div class="action-product">
            <div class="title-avis">
                <p><?php echo $titlePro; ?></p>
                <?php include_once(include_path('database/db.php'));;
                $pdostat = $pdo->prepare("SELECT ROUND(AVG(note_avis))
FROM avis
WHERE product_id = :product_id");
                $pdostat->bindParam(":product_id", $_GET["id_product"]);
                $pdostat->execute();
                $row = $pdostat->fetch();
                //print_r($row);
                ?>
                <img src="<?php echo asset('assets/imgs/rating-stars/') ?><?php print_r($row[0]); ?>STARS.png" alt="">
            </div>
            <div class="addToCart">
                <form class="form-addToCart" action="<?php echo route('controllers/AddCartController.php') ?>?idProduct=<?php echo $idProduct; ?>" method="POST">
                    <select name="" id="taille">
                        <option value="none" selected disabled hidden>Taille</option>
                        <option value="">S</option>
                        <option value="">L</option>
                        <option value="">XL</option>
                    </select>
                    <input <?php if (!$quantity) {
                                echo "disabled= 'disabled'";
                            } ?> type="submit" id="submit-button" value="AJOUTER AU PANIER">
                    <button type="button" onclick="add_favoris(<?php print($_GET['id_product']); ?>,<?php print($_SESSION['id']); ?>)" id="favoris-button">FAVORIS <i class="fa-light fa-heart"></i> </button>
                </form>
            </div>
            <div class="description">
                <p><?php echo $desc ?></p>
            </div>
        </div>
    </div>
    <div class="make_avis">
        <h2>FAIRE UN AVIS</h2>
        <form action="<?php echo route('controllers/AddAvisController.php'); ?>" class="form_make_avis">
            <div class="zone_text_avis">
                <input type="text" name=title_avis placeholder="Entrer le titre de votre avis" required>
                <textarea name="desc_avis" id="" cols="30" rows="5" placeholder="Entrer votre avis" required></textarea>
                <input type="submit" value="VALIDER">
            </div>
            <div class="stars">
                <input class="star star-5" id="star-5-2" type="radio" name="star" value="5" required />
                <label class="star star-5" for="star-5-2"></label>
                <input class="star star-4" id="star-4-2" type="radio" name="star" value="4" />
                <label class="star star-4" for="star-4-2"></label>
                <input class="star star-3" id="star-3-2" type="radio" name="star" value="3" />
                <label class="star star-3" for="star-3-2"></label>
                <input class="star star-2" id="star-2-2" type="radio" name="star" value="2" />
                <label class="star star-2" for="star-2-2"></label>
                <input class="star star-1" id="star-1-2" type="radio" name="star" value="1" />
                <label class="star star-1" for="star-1-2"></label>
            </div>
            <input type="hidden" name="id_product" value="<?php print($_GET['id_product']) ?>">
        </form>
    </div>
    <div class="avis">
        <h2>AVIS</h2>
        <div class="avis-presentation">
            <div class="note-producte">
                <div class="note">
                    <p><?php print_r($row[0]) ?>/5</p>
                    <img src="<?php echo asset('assets/imgs/rating-stars/') ?><?php print_r($row[0]) ?>STARS.png" alt="">
                    <p><?php
                        $pdoStat =  $pdo->prepare("SELECT quantity_producte FROM productes WHERE id_producte = :id_product ");
                        $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                        $pdoStat->execute();
                        $row = $pdoStat->fetch();
                        print_r($row["quantity_producte"]);  ?> exemplaire restant</p>
                </div>
                <div class="note-spe">
                    <div>
                        <p><?php
                            $pdoStat =  $pdo->prepare("SELECT COUNT(note_avis) FROM avis WHERE product_id = :id_product AND note_avis = 5");
                            $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                            $pdoStat->execute();
                            $row = $pdoStat->fetch();
                            print_r($row["COUNT(note_avis)"]);

                            ?></p> <img src="<?php echo asset('assets/imgs/rating-stars/') ?>5STARS.png" alt="">
                    </div>
                    <div>
                        <p><?php
                            $pdoStat = $pdo->prepare("SELECT COUNT(note_avis) FROM avis WHERE product_id = :id_product AND note_avis = 4");
                            $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                            $pdoStat->execute();
                            $row = $pdoStat->fetch();
                            print_r($row["COUNT(note_avis)"]);
                            ?></p><img src="<?php echo asset('assets/imgs/rating-stars/') ?>4STARS.png" alt="">
                    </div>
                    <div>
                        <p><?php
                            $pdoStat = $pdo->prepare("SELECT COUNT(note_avis) FROM avis WHERE product_id = :id_product AND note_avis = 3");
                            $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                            $pdoStat->execute();
                            $row = $pdoStat->fetch();
                            print_r($row["COUNT(note_avis)"])
                            ?></p><img src="<?php echo asset('assets/imgs/rating-stars/') ?>3STARS.png" alt="">
                    </div>
                    <div>
                        <p><?php
                            $pdoStat = $pdo->prepare("SELECT COUNT(note_avis) FROM avis WHERE product_id = :id_product AND note_avis = 2");
                            $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                            $pdoStat->execute();
                            $row = $pdoStat->fetch();
                            print_r($row["COUNT(note_avis)"])
                            ?></p><img src="<?php echo asset('assets/imgs/rating-stars/') ?>2STARS.png" alt="">
                    </div>
                    <div>
                        <p><?php
                            $pdoStat = $pdo->prepare("SELECT COUNT(note_avis) FROM avis WHERE product_id = :id_product AND note_avis = 1");
                            $pdoStat->bindParam(":id_product", $_GET["id_product"]);
                            $pdoStat->execute();
                            $row = $pdoStat->fetch();
                            print_r($row["COUNT(note_avis)"]);
                            ?></p><img src="<?php echo asset('assets/imgs/rating-stars/') ?>1STARS.png" alt="">
                    </div>
                </div>
            </div>
            <div class="first-avis">
                <?php
                include_once(include_path('database/db.php'));;
                $pdoStat = $pdo->prepare("SELECT title_avis,desc_avis,note_avis,id_user,id_avis
                        FROM avis WHERE product_id = :product_id
                        ORDER BY note_avis DESC
                        LIMIT 2 ");
                $pdoStat->bindParam(":product_id", $_GET["id_product"]);
                $pdoStat->execute();
                $row = $pdoStat->fetchAll();
                //print_r(($row));
                ?>
                <div id="avis_box_<?php if (isset($row[0]["id_avis"])) {
                                        print($row[0]["id_avis"]);
                                    } ?>" class="avis_box">

                    <h4 id="title_<?php if (isset($row[0]["id_avis"])) {
                                        print($row[0]["id_avis"]);
                                    }  ?>"> <?php if (isset($row[0]["title_avis"])) {
                                                print($row[0]["title_avis"]);
                                            } ?>
                    </h4>
                    <p id="desc_<?php if (isset($row[0]["id_avis"])) {
                                    print($row[0]["id_avis"]);
                                }  ?>">
                        <?php if (isset($row[0]["desc_avis"])) print($row[0]["desc_avis"]); ?>
                    </p>
                    <img id="img_<?php if (isset($row[0]["id_avis"])) {
                                        print($row[0]["id_avis"]);
                                    }  ?>" <?php echo asset('assets/imgs/rating-stars/') ?><?php if (isset($row[0]["note_avis"])) print($row[0]["note_avis"]); ?>STARS.png" alt="">

                    <div class="move_delete_avis" id="icon_<?php if (isset($row[0]["id_avis"])) {
                                                                print($row[0]["id_avis"]);
                                                            }  ?>">
                        <?php
                        if (isset($row[0]["id_user"]) && $row[0]["id_user"] === $_SESSION["id"]) {
                            print('<a href="' . route('controllers/DeleteAvisController.php') . '?id_avis=' . $row[0]["id_avis"] . '"><i class="fa-solid fa-trash-can"></i></a>
                            <i class="fa-solid fa-pen" onclick="modify_avis(' . $row[0]["id_avis"] . ')"></i>');
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class=" seconde-avis">
                <div id="avis_box_<?php if (isset($row[1]["id_avis"])) {
                                        print($row[1]["id_avis"]);
                                    } ?>" class="avis_box">

                    <h4 id="title_<?php if (isset($row[1]["id_avis"])) {
                                        print($row[1]["id_avis"]);
                                    }  ?>"><?php if (isset($row[1]["title_avis"])) {
                                                print($row[1]["title_avis"]);
                                            } ?></h4>
                    <p id="desc_<?php if (isset($row[1]["id_avis"])) {
                                    print($row[1]["id_avis"]);
                                }  ?>"><?php if (isset($row[1]["desc_avis"]))  print($row[1]["desc_avis"]); ?></p>
                    <img id="img_<?php if (isset($row[1]["id_avis"])) {
                                        print($row[1]["id_avis"]);
                                    }  ?>" <?php echo asset('assets/imgs/rating-stars/') ?><?php if (isset($row[1]["note_avis"])) print($row[1]["note_avis"]); ?>STARS.png" alt="">

                    <div class="move_delete_avis" id="icon_<?php if (isset($row[1]["id_avis"])) {
                                                                print($row[1]["id_avis"]);
                                                            }  ?>">
                        <?php
                        if (isset($row[1]["id_user"]) && $row[1]["id_user"] === $_SESSION["id"]) {
                            print('<a href="' . route("controllers/DeleteAvisController.php") . '?id_avis=' . $row[1]["id_avis"] . '"><i class="fa-solid fa-trash-can"></i></a>
                            <i class="fa-solid fa-pen" onclick="modify_avis(' . $row[1]["id_avis"] . ')"></i>');
                        }
                        if (isset($row[0]["id_avis"])) {
                            $id_avis_0 = $row[0]["id_avis"];
                        }
                        if (isset($row[1]["id_avis"])) {
                            $id_avis_1 = $row[1]["id_avis"];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <button id="button_open_avis" onclick="open_avis()">VOIR PLUS</button>
    </div>
    <div class="container_avis">
        <div class="container_avis_avis">
            <?php
            include_once(include_path('database/db.php'));;
            $pdoStat = $pdo->prepare("SELECT title_avis,desc_avis,note_avis,id_user,id_avis
                        FROM avis WHERE product_id = :product_id  
                        ORDER BY note_avis DESC
                         ");
            $pdoStat->bindParam(":product_id", $_GET["id_product"]);
            $pdoStat->execute();

            while ($data = $pdoStat->fetch()) {
                if (isset($id_avis_0) && isset($id_avis_1)) {
                    if ($data["id_avis"] != $id_avis_1 && $data["id_avis"] != $id_avis_0) {
                        print('<div id="avis_box_' . $data["id_avis"] . '" class="avis_box">
            <h4 id="title_');
                        if (isset($data["id_avis"])) {
                            print($data["id_avis"] . '">');
                        }

                        if (isset($data["title_avis"])) {
                            print($data["title_avis"]);
                        }
                        print('</h4>
            <p id="desc_');
                        if (isset($data["id_avis"])) {
                            print($data["id_avis"] . '">');
                        }
                        if (isset($data["desc_avis"])) {
                            print($data["desc_avis"]);
                        }
                        print('</p>
            <img id="img_' . $data["id_avis"] . asset('assets/imgs/rating-stars/'));
                        if (isset($data["note_avis"])) {
                            print($data["note_avis"] . 'STARS.png" alt="">');
                        }
                        print('<div id="icon_' . $data["id_avis"] . '" class="move_delete_avis">');
                        if (isset($data["id_user"]) && $data["id_user"] === $_SESSION["id"]) {
                            print('<a href="' . route("controllers/DeleteAvisController.php") . '?id_avis=' . $data["id_avis"] . '"');
                            print('><i class="fa-solid fa-trash-can"></i></a>
                <i class="fa-solid fa-pen" onclick="modify_avis(' . $data["id_avis"] . ')"></i>');
                        }


                        print('</div>');
                        print('</div>');
                    }
                }
            }
            ?>
        </div>
        <div class="button_close_avis">
            <button id="button_open_avis" onclick="open_avis()">VOIR MOINS</button>
        </div>

    </div>

</section>
<?php
include(include_path('includes/reseaux.php'));
?>
<?php
include(include_path('includes/footer.php'));
?>
<script src="<?php echo asset('assets/js/article_zoom.js') ?>"></script>