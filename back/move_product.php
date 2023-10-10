<?php
require('./database/db.php');
$messageNamePro = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$messagePrice = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$messageDesc = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$messagePhoto = "<font style='font-size:70%;' color = red>*Pour ajouter le produit, il faut avoir au moin une photo</font><br>";
$messageKey = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";
$messageStyle = "<font style='font-size:70%;' color = red>*Le champs ne respecte pas les convention du site</font><br>";

$isNamePro = false;
$nameIsExist = false;
$isBrand = false;
$isPrice = false;
$isDesc = false;
$isQuant = false;
$isPhoto = false;
$isUploadPhoto = false;
$isKey = false;
$isStyle = false;
$isCat = false;
$isPosted = false;
if(!empty($_POST)){
    //GET ID PRODUCT
    $isPosted=true;
    $id_product = $_GET['id_producte'];
    $image = $_POST['fileToUpload'];

    //POST infomations from SQL
    require_once('./database/db.php');
    $data = $pdo -> query("SELECT DISTINCT * FROM productes INNER JOIN brands ON brands.id_brand = productes.brand_producte WHERE id_producte != $id_product");

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
        $id_brand = intval($_POST['brand']);
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
        if(is_numeric($_POST['quantity'])){
            $quantity = intval($_POST['quantity']);
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

    //check keyword
    if(isset($_POST['style'])){
        $style = $_POST['style'];
        if($style){
            $isStyle = true;
        }
        else{
            $messageStyle = "<font style='font-size:70%;' color = red>*Mot Clé est obligatoire</font><br>";
        }
    }

    // IF YOU HAD CHANGED THE PHOTO, YOU HAVE TO UPDATE THE PHOTO
    // UPDATE SQL

    if($isCat && $isNamePro && $isBrand && $isQuant && $isPrice && $isDesc && $isKey){
        $insertIsOk = false;
        if (!$isPhoto){
            $add = $pdo->prepare("UPDATE productes SET cat_producte = :id_categorie, brand_producte = :id_brand, title_producte = :namePro, price_producte = :price, quantity_producte = :quantity, desc_producte = :descr WHERE id_producte =:id_producte");
        }
        else{      
            $add = $pdo->prepare("UPDATE productes SET cat_producte = :id_categorie, brand_producte = :id_brand, title_producte = :namePro, price_producte = :price, quantity_producte = :quantity, desc_producte = :descr, image_producte = :photo WHERE id_producte =:id_producte");
            $add->bindParam(':photo', $photo);
        }

        $add->bindParam(':id_producte', $id_product);
        $add->bindParam(':id_categorie', $id_categorie);
        $add->bindParam(':id_brand', $id_brand);
        $add->bindParam(':namePro', $namePro);
        $add->bindParam(':price', $price);
        $add->bindParam(':quantity', $quantity);
        $add->bindParam(':descr', $description);
        
        $insertIsOk = $add->execute();     

        $id_product = $_GET['id_producte'];


        // Keyword table update
        $arrayKeyWord = explode(" ", $keyword);   

        $dataKey = $pdo -> query("SELECT * FROM keyswords ORDER BY 	id_keys_word DESC");
        $key = $dataKey -> fetchAll();
        
        $dataKeysword_producte = $pdo -> query("SELECT keyswords_id FROM productes INNER JOIN keysword_producte ON productes.id_producte = keysword_producte.producte_id WHERE id_producte =$id_product;");
        $oldKey = $dataKeysword_producte -> fetchAll();

        
        //REMOVE OLD KEYWORD
        $removeKey = $pdo -> query("DELETE FROM keysword_producte WHERE producte_id = $id_product");

        //ADD NEW KEYWORD
        foreach($arrayKeyWord as $inputKey){
            foreach($key as $cle){
                if($cle['keys_word_title'] == $inputKey){
                
                    $idKey = intval($cle['id_keys_word']);
                    $addKey = $pdo -> query("INSERT INTO keysword_producte(keyswords_id, producte_id) VALUES ($idKey,$id_product)");

                }
            }
        }

        // Style table update

        $arrayStyle = explode(" ", $style);   
        $dataStyle = $pdo -> query("SELECT * FROM styles ORDER BY id_style DESC");
        $style_data = $dataStyle -> fetchAll();
        
        $dataStyle_producte = $pdo -> query("SELECT style_id FROM productes INNER JOIN styles_productes ON productes.id_producte = styles_productes.producte_id WHERE id_producte =$id_product;");
        $oldStyle = $dataStyle_producte -> fetchAll();

        
        //REMOVE OLD KEYWORD
        $removeStyle = $pdo -> query("DELETE FROM styles_productes WHERE producte_id = $id_product");
        //ADD NEW KEYWORD
        foreach($arrayStyle as $inputKey){
            
            foreach($style_data as $cle){
                if($cle['title_style'] == $inputKey){
                    $idStyle = intval($cle['id_style']);
                    $addStyle = $pdo -> query("INSERT INTO styles_productes(style_id, producte_id) VALUES ($idStyle,$id_product)");
                }
            }
        }

        //redirection sur la page accueil
        if ($insertIsOk) {
            // header("Location: ./profil-admin.php?page=InfosProduit");
            // die();
        }else{
            echo "NO";
        }
    }
    else{
        $dataBrand = $pdo -> query("SELECT * FROM brands ORDER BY id_brand DESC ");
        $dataCat = $pdo -> query("SELECT * FROM categories ORDER BY id_categorie DESC ");
    }   
}

if(isset($_GET['id_producte']) && isset($_GET['brand'])){
    $id_product = intval($_GET['id_producte']);
    $title_brand = $_GET['brand'];
    $dataPro = $pdo -> query("SELECT * FROM productes WHERE id_producte = $id_product");
    $dataBrand = $pdo -> query("SELECT * FROM brands;");
    $dataCat = $pdo -> query("SELECT * FROM categories ORDER BY id_categorie DESC ");

    while($rowPro = $dataPro -> fetch()){
        if (!$isNamePro)
            $namePro = $rowPro['title_producte'];
        if (!$isPrice)
            $price = $rowPro['price_producte'];
        if (!$isDesc)
            $description = $rowPro['desc_producte'];
        if (!$isPhoto)
            $img_producte = $rowPro['image_producte'];
        if (!$isKey){
            //$keyword = $rowPro['keyword_producte'];
            $keyword = "";
            $dataKeyPro = $pdo -> query("SELECT keyswords_id FROM keysword_producte WHERE producte_id = $id_product;");
            $rowIdKey = $dataKeyPro -> fetchAll();
            $dataKey = $pdo -> query("SELECT * FROM keyswords;");
            $rowNameKey = $dataKey -> fetchAll();
            foreach($rowIdKey as $clePro => $valuePro){
                
                foreach($rowNameKey as $cleKey => $valueKey){
                    if(intval($valuePro['keyswords_id']) == intval($valueKey['id_keys_word'])){
                        $keyword = $keyword ." ". $valueKey['keys_word_title'];                   
                    }
                }
            }
            $keyword = trim($keyword);
        }
        if (!$isStyle){
            $style = "";
            $dataStylePro = $pdo -> query("SELECT style_id FROM styles_productes WHERE producte_id = $id_product;");
            $rowIdStyle = $dataStylePro -> fetchAll();
            $dataStyle = $pdo -> query("SELECT * FROM styles;");
            $rowNameStyle = $dataStyle -> fetchAll();
            foreach($rowIdStyle as $clePro => $valuePro){
                foreach($rowNameStyle as $cleStyle => $valueStyle){
                    if(intval($valuePro['style_id']) == intval($valueStyle['id_style'])){
                        $style = $style ." ". $valueStyle['title_style'];                   
                    }
                }
            }
            $style = trim($style);
        }
        
        if (!$isQuant)
            $quantity = intval($rowPro['quantity_producte']);
        $id_cat = $rowPro['cat_producte'];
    }

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
    include('./move_product.php');
}