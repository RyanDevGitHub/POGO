<?php

$isNamePro = false;
$messageNamePro = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isBrand = false;
$messageBrand = "<font style='font-size:70%;' color = red>*La catégorie n'existe pas</font><br>";
$isPrice = false;
$messagePrice = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isDesc = false;
$messageDesc = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isQuant = false;
$messageQuant = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isPhoto = false;
$messagePhoto = "<font style='font-size:70%;' color = red>*Pour ajouter le produit, il faut avoir au moin une photo</font><br>";
$isKey = false;
$messageKey = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isCat = false;
$messageCat = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$isPosted = false;
$isStyle = false;
$messageStyle = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";

$namePro = "";
$price = "";
$keyword = "";
$style = "";
$description = "";
$title_brand = "";
$title_categorie="";
$id_brand = 0;
$id_cat = 0;
$quantity = 0;

if(!empty($_POST)){

    //POST infomations from SQL
    $isPosted=true;
    require_once('./database/db.php');
    $data = $pdo -> query("SELECT DISTINCT * FROM productes INNER JOIN brands WHERE brands.id_brand = productes.brand_producte");

    $product = [];
    while($rowPro = $data -> fetch()){
        $elmArray = array('id_brand'=> $rowPro['id_brand'], "title_producte" =>  $rowPro['title_producte']);
        array_push($product, $elmArray);
    }
    //check title_producte
    if(isset($_POST['nameProduct'])){
        $namePro = $_POST['nameProduct'];
        $lenName = strlen($namePro);
        //ctype_alnum(preg_replace('/\s+/', '', $_POST['nameProduct'])) 
        if($lenName == 0)
        {
            $messageNamePro = "<font style='font-size:70%;' color = red>*Nom de l'article est obligatoire </font><br>";
            $isNamePro = false;                
        }
        elseif($lenName < 25 && $lenName > 2){        
            $isNamePro = true;
            foreach($product as $cle){
                // echo $cle['title_producte'] . "&". $_POST['nameProduct']."<br>";
                if($namePro == $cle['title_producte'] && intval($_POST['brand']) == $cle['id_brand'] ){
                    $messageNamePro = "<font style='font-size:70%;' color = red>*L'article est exist déjà </font><br>";
                    $isNamePro = false;
                }
            }       
        }
        else{
            $messageNamePro = "<font style='font-size:70%;' color = red>*Nom de l'article est trop court ou trop long </font><br>";
        }
    }
    //check brand
    if(isset($_POST['brand'])){
        $id_brand = floatval($_POST['brand']);
        $isBrand = true;
    }
    
    //check categorie
    if(isset($_POST['categorie'])){
        $id_categorie = intval($_POST['categorie']);
        $isCat = true;
    }

    //check price
    if(isset($_POST['price'])){
        if ($_POST['price'] == ""){
            $messagePrice = "<font style='font-size:70%;' color = red>*Prix est obligatoire</font><br>";
        }
        else{
            $price = str_replace(',', '.', $_POST['price']);
            if(is_numeric($price)){
                $price = floatval($price);
                $isPrice = true;
            }
            else{
                $messagePrice = "<font style='font-size:70%;' color = red>*Price devrait être une nombre</font><br>";
            }
        }
    }

    //check description
    if(isset($_POST['description'])){
        $len_desc = strlen($_POST['description']);
        if ($len_desc == 0)
        {
            $messageDesc = "<font style='font-size:70%;' color = red>*Description est obligatoire</font><br>";       
        }
        elseif(strlen($_POST['description']) < 50){
            $description = $_POST['description'];
            $isDesc = true;
        }
        else{
            $messageDesc = "<font style='font-size:70%;' color = red>*Description est trop long</font><br>";       
        }
    }
    
    //check quantity
    if(isset($_POST['quantity'])){
        if(intval($_POST['quantity'])){
            $quantity = $_POST['quantity'];
            $isQuant = true;
        }
    }

    //check photo
    if(isset($_FILES['fileToUpload'])){
        $errors= array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];

        // exchange the name of file to an array
        $file_parts = explode('.',$_FILES['fileToUpload']['name']);

        // the end of the array
        $file_ext = strtolower(end($file_parts));
        $expensions= array("jpeg","jpg","png");

        if (in_array($file_ext, $expensions) == false){
            $messagePhoto = "<font style='font-size:70%;' color = red>*Pour ajouter le produit, il faut avoir au moin une photo</font><br>";
        }
        elseif($file_size > 2097152){
            $messagePhoto = "<font style='font-size:70%;' color = red>*La size de photo est trop grande</font><br>";
        }
        else{
            $photo = $_FILES['fileToUpload']['name'];
            //add photo to server PC
            $file = $_FILES['fileToUpload']['tmp_name'];
            $path = "./res/photo_product/".$_FILES['fileToUpload']['name'];
            if(move_uploaded_file($file, $path)){
                $isPhoto = true;
            }else{
                $messagePhoto = "<font style='font-size:70%;' color = red>*Erreur de téléchargerment</font><br>";
            }
        }
    }

    //check keyword
    if(isset($_POST['keyword'])){
        $keyword = $_POST['keyword'];
        if($keyword){
            $isKey = true;
        }
        else{
            $messageKey = "<font style='font-size:70%;' color = red>*Mot Clé est obligatoire</font><br>";
        }
    }
     //check style
     if(isset($_POST['style'])){
        $style = $_POST['style'];
        if($style){
            $isStyle = true;
        }
        else{
            $messageStyle = "<font style='font-size:70%;' color = red>*Style est obligatoire</font><br>";
        }
    }
    //add infomations into SQL

    if ($isCat && $isNamePro && $isBrand && $isQuant && $isPrice && $isPhoto && $isDesc && $isKey ){
        $add = $pdo->prepare("INSERT INTO productes(cat_producte, brand_producte, title_producte, price_producte, quantity_producte, desc_producte, image_producte) VALUES( :id_categorie,:id_brand, :namePro, :price, :quantity, :descr, :photo)");

        $add->bindParam(':id_categorie', $id_categorie);
        $add->bindParam(':id_brand', $id_brand);
        $add->bindParam(':namePro', $namePro);
        $add->bindParam(':price', $price);
        $add->bindParam(':quantity', $quantity);
        $add->bindParam(':descr', $description);
        $add->bindParam(':photo', $photo);
        
        $insertIsOk = $add->execute();
        $id_producte = $pdo->lastInsertId();


        // Add keyword in new product
        $arrayKeyWord = explode(" ", $keyword);   
        $isOkAddKeyWord = True;
        $dataKey = $pdo -> query("SELECT * FROM keyswords ORDER BY 	id_keys_word DESC");
        $key = $dataKey -> fetchAll();

        foreach($arrayKeyWord as $inputKey){
            // search key_id from key:
            foreach($key as $cle){
                if($cle['keys_word_title'] == $inputKey){
                    $idKey = intval($cle['id_keys_word']);
                    $addKeyWord = $pdo->prepare("INSERT INTO keysword_producte(keyswords_id,producte_id) VALUES(:id_key_word, :id_producte)");
                    $addKeyWord->bindParam(':id_key_word', $idKey);
                    $addKeyWord->bindParam(':id_producte', $id_producte);
                    $isOk = $addKeyWord->execute();
                    if (!$isOk)
                        $isOkAddKeyWord = False;
                }
            }
        }

        // Add style in new product
        $arrayStyle = explode(" ", $style);   

        $dataStyle = $pdo -> query("SELECT * FROM styles ORDER BY id_style DESC");
        $style_data = $dataStyle -> fetchAll();
        $isOkAddStyle = True;

        foreach($arrayStyle as $inputStyle){
            // search key_id from key:
            foreach($style_data as $cle){
                if($cle['title_style'] == $inputStyle){
                    $idStyle = intval($cle['id_style']);
                    $addStyle = $pdo->prepare("INSERT INTO styles_productes(style_id,producte_id) VALUES(:id_style, :id_producte)");
                    $addStyle->bindParam(':id_style', $idStyle);
                    $addStyle->bindParam(':id_producte', $id_producte);
                    $isOk = $addStyle->execute();
                    if (!$isOk)
                        $isOkAddStyle = False;
                }
            }
        }

        //redirection sur la page accueil
        if ($insertIsOk && $isOkAddStyle && $isOkAddKeyWord) {
            header("Location: ./profil-admin.php?page=InfosProduit");
            die();
        }
    }
}

$dataBrand = $pdo -> query("SELECT * FROM brands ORDER BY id_brand DESC ");
$dataCat = $pdo -> query("SELECT * FROM categories ORDER BY id_categorie DESC ");


$categorie = [];
while($rowCat = $dataCat -> fetch()){
    if($id_cat !== $rowCat['id_categorie']){
        $arrayCat = array('id_categorie'=> $rowCat['id_categorie'], "title_categorie" =>  $rowCat['title_categorie']);
        array_push($categorie, $arrayCat);
    }else {
        $title_categorie = $rowCat['title_categorie'];
    }
}

$brand = [];
while($rowBrand = $dataBrand -> fetch()){
    if($title_brand == $rowBrand['title_brand'] ){
        $id_brand = $rowBrand['id_brand'];
    }
    else{
        $arrayBrand = array('id_brand'=> $rowBrand['id_brand'], "title_brand" =>  $rowBrand['title_brand']);
        array_push($brand, $arrayBrand);
    }
}

$dataKey = $pdo -> query("SELECT * FROM keyswords ORDER BY 	id_keys_word DESC");
$key = $dataKey -> fetchAll();

$dataStyle = $pdo -> query("SELECT * FROM styles ORDER BY id_style DESC");
$styleList = $dataStyle ->fetchAll();

include('./add_product.php');