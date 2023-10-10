 <!--DEBUT HISTORIQUE-->
 <div class="historique_de_commande">
     <h2>Historique de Commande</h2>
 </div>
 <!--FIN HISTORIQUE-->

 <?php
require_once('./database/db.php');
$id_user = $_SESSION['id'];

$dataPro = $pdo -> query("SELECT title_producte,
SUM(price_producte * C.quantity) AS total, 
image_producte, 
C.date_commande, 
C.statue, 
C.sessions,
SUM(C.quantity) AS quantité 
FROM productes P INNER JOIN cart C 
ON P.id_producte = C.id_producte 
WHERE C.statue = 'livrer' 
AND id_user = $id_user
GROUP BY C.sessions
ORDER BY C.date_commande DESC;");
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
             <th>N° de commande</th>
             <th>Les articles</th>
             <th>Total</th>
             <th>Etat de la comande</th>
             <th>date de la commande</th>

         </tr>
     </thead>
     <tbody>
         <?php
            while ($rowPro = $dataPro->fetch()) {
            ?>
         <tr>
             <td> <?php echo $rowPro['sessions']; ?> </td>
             <td> <a href="./profil.php?sectionProfile=historyCommandDetail&session=<?php echo $rowPro['sessions'] ?>"><img
                         width="100px" height="150px"
                         src='./res/photo_product/<?php echo $rowPro['image_producte']; ?>'></a><br>
                 <?php echo $rowPro['quantité']; ?> article(s)</td>
             <td> <?php if($rowPro['total'] >= 50 || $rowPro['total'] == 0){
                echo $rowPro['total'];
             }
             else{
                $total = floatval($rowPro['total']) + 4.99;
                echo $total;
            } 
             
                ?>€ </td>
             <td> <?php echo $rowPro['statue']; ?> </td>
             <td> <?php if(!empty($rowPro['date_commande'])){echo $rowPro['date_commande'];} ?> </td>
         </tr>
         <?php
            }
            ?>
     </tbody>
 </table>