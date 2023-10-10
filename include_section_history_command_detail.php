 <!--DEBUT HISTORIQUE-->
 <div class="historique_de_commande">
     <h2>MES COMMANDES</h2>
 </div>
 <!--FIN HISTORIQUE-->

 <?php
require_once('./database/db.php');
$id_user = $_SESSION['id'];
$id_session = $_GET['session'];
$dataPro = $pdo -> query("SELECT title_producte,
price_producte AS total, 
image_producte, 
C.date_commande, 
C.statue, 
C.sessions,
C.quantity AS quantité,
C.id_producte
FROM productes P INNER JOIN cart C 
ON P.id_producte = C.id_producte 
WHERE C.statue = 'livrer' 
AND id_user = $id_user
AND sessions = '$id_session';");
// $dataPro = $pdo->query("SELECT title_producte, price_producte, image_producte, C.date_commande, C.statue, C.quantity
// FROM productes P INNER JOIN cart C 
// ON P.id_producte = C.id_producte 
// WHERE id_user = $id_user
// ORDER BY C.date_commande ASC;");
// $rowPro($dataPro -> fetchAll());

?>
 <table style="width:100%">
     <thead>
         <tr>
             <th>ID article</th>
             <th>Nom de article</th>
             <th>Prix</th>
             <th>Quantité</th>
             <th>Etat de la comande</th>
             <th>date de la commande</th>

         </tr>
     </thead>
     <tbody>
         <?php
            $piece = 0;
            $total = 0;
            $totalGene = 0;
            while ($rowPro = $dataPro->fetch()) {
                $piece += intval($rowPro['quantité']);
                $total += floatval($rowPro['total']) * intval($rowPro['quantité']);
            ?>
         <tr>

             <td> <?php echo $rowPro['id_producte']; ?> </td>

             <td> <a href="./page-article-zoom.php?id_product=<?php echo $rowPro['id_producte']; ?>"><img width="100px"
                         height="150px" src='./res/photo_product/<?php echo $rowPro['image_producte']; ?>'></a></td>
             <td> <?php echo $rowPro['total'];?> € </td>
             <td> <?php echo $rowPro['quantité']; ?> </td>
             <td> <?php echo $rowPro['statue']; ?> </td>
             <td> <?php if(!empty($rowPro['date_commande'])){echo $rowPro['date_commande'];} ?> </td>
         </tr>
         <?php
            }
            if($total >= 50 || $total == 0){
                $totalGene = $total;
            }
            else{
                $livraison = 4.99;
                $totalGene = $total + $livraison;
            }
            ?>
         <tr>
             <td colspan="5"><strong>Total :</strong></td>
             <td>
                 <?php echo $totalGene; ?> €
             </td>
         </tr>
     </tbody>
 </table>
 <div id="btn_div">
     <a id="btnRetourner" href="./profil.php?sectionProfile=historyCommand">Retourner</a>
 </div>