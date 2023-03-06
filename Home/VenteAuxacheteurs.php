<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">



	<title></title>
	<style type="text/css">
	
	</style>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>
	
</head>
<body>
	<?php 
	require("../Header.php");
	if(isset($_SESSION['username'])){
?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
<center><h3>Vente Aux Acheteurs</h3></center>
</div>
	
<div style="background-image: radial-gradient(pink, ivory);">
<i class="fa-light fa-rectangle-history-circle-plus"></i>	
<a href="../Create/Add_VenteAuxAcheteurs.php" ><i class="fa-solid fa-circle-plus" style="margin-left: 1600px;font-size: 30px;"></i></a>
</div>
	
<?php 
    require("../Side/Sidebar.php");
    require("../Side/database.php");



$messagesParPage=12; 
$retour_total=$pdo->prepare("SELECT * FROM Ventes WHERE Categorie_Abonne =?"); 
$retour_total->execute(array("null")); 
$total=$retour_total->rowcount();
 if ($total>0) {
 			?>
 			
 			 <div class="table-responsive" style="height: 600px;overflow-y: scroll; margin-top: -650px;margin-left:350px; " id="section">
 			 <table class="table table-striped table-hover table-bordered">
 			 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Produit</th><th>Montant</th><th>Date de Vente</th><th>Date de Paiement</th><th>MODIFIER</th><th>SUPPRIMER</th>
 			 	</tr>
 			 </thead>
 		<?php
 	
//Nous allons maintenant compter le nombre de pages.
$nombreDePages=ceil($total/$messagesParPage);
 
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nombreDePages) 
     {
          $pageActuelle=$nombreDePages;
     }
}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1    
}
 
$premiereEntree=($pageActuelle-1)*$messagesParPage; 
$retour_messages=$pdo->prepare("SELECT  * FROM Ventes WHERE Categorie_Abonne =? ORDER BY Id_Vente DESC LIMIT ?,?");
$retour_messages->execute(array("null",$premiereEntree,$messagesParPage));
 setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
while($repo=$retour_messages->fetch(PDO::FETCH_ASSOC)) 
{				
				$date1=$repo['Date_Vente'];
 				$datevente = utf8_encode(strftime("%A %d %B %Y", strtotime($date1)));
				$date2=$repo['Date_Paiement'];
 				$datepay = utf8_encode(strftime("%A %d %B %Y", strtotime($date2)));
 				?>
    
 				<tr>
 					
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $repo['Montant'];?></td>
 					<td> <?php  echo $datevente;?></td>
 					<td> <?php  echo $datepay;?></td>
 					
 					
 					
 					<td> <a href ="../Modification/Change_VenteAuxAcheteurs.php?id=<?php echo $repo['Id_Vente'];?>"> modifier<a></td>
                    <td> <a href ="../Delete/Delete_VenteAuxAcheteurs.php ?id=<?php echo $repo['Id_Vente'];?>" onclick="return confirm('Voulez-vous supprimer?')"> Supprimer<a></td>
 				</tr>
 				<?php 	
 			}
 			?>
 				</table>
 				</center>
 		<?php 
 
echo '<h6 align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     
     if($i==$pageActuelle) 
     {
         echo ' [ '.$i.' ] '; 
     }    
     else //Sinon...
     {
          echo ' <a href="VenteAuxAcheteurs.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</h6>';



 		}else{
 			echo "Vous n'avez aucun enregistrement!";
 		}
 }else{
 		?>
 		<center><p style= "color: red;letter-spacing: 1px;" > Vous n'etes pas connectés!! <a href="../Index.php">Connectez-vous</a></p></center>
 		<?php
 	}
  ?>
</div>
<?php
 require("../Footer.php");
?>
 </body>
</html>