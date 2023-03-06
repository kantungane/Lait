<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		
		
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
<center><h3>Programme des abonnés</h3></center>
</div>
	
<div style="background-image: radial-gradient(pink, ivory);">
<a href="../Create/Add_Abonnement.php" ><i class="fa-solid fa-circle-plus" style="margin-left: 1600px;font-size: 30px;"></i></a>
</div>
	
<?php 
require("../Side/Sidebar.php");
require("../Side/database.php");


$messagesParPage=12; 
$retour_total=$pdo->prepare("SELECT * FROM Abonnements"); 
$retour_total->execute(array()); 
$total=$retour_total->rowcount();
 if ($total>0) {
 			?>
 			
 			 <div class="table-responsive" style="height: 600px;overflow-y: scroll; margin-top: -650px;margin-left:350px; " id="section">
 			 <table class="table table-striped table-hover table-bordered ">
 			 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Categorie</th><th>Produit</th><th>Debut</th><th>Fin</th><th>Date d'enregistrement</th><th>MODIFIER</th><th>SUPPRIMER</th>
 			 	</tr>
 			 </thead>
 			 <?php
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
$retour_messages=$pdo->prepare("SELECT  * FROM Abonnements ORDER BY Id_Abonnement DESC  LIMIT ?,?");
$retour_messages->execute(array($premiereEntree,$messagesParPage));
 
while($repo=$retour_messages->fetch(PDO::FETCH_ASSOC)) 
{               setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
 				$date1=$repo['Date_Debut'];

 				$datedebut = utf8_encode(strftime("%A %d %B %Y", strtotime($date1)));

				$date2=$repo['Date_Fin'];
 				$datefin = utf8_encode(strftime("%A %d %B %Y", strtotime($date2)));
 				$date3=$repo['Date_enreg'];
 				$datereg = utf8_encode(strftime("%A %d %B %Y", strtotime($date3)));
 				?>
 				<tr>
 				
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					<td> <?php  echo  $repo['Categorie_Abonne'] ;?></td>
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $datedebut;?></td>
 					<td> <?php  echo $datefin;?></td>
 					<td> <?php  echo $datereg ;?></td>
 					<td> <a href ="../Modification/Change_Abonnement.php?id=<?php echo $repo['Id_Abonnement'];?>"> modifier<a></td>
 				<td> <a href ="../Delete/Delete_Abonnement.php ?id=<?php echo $repo['Id_Abonnement'];?>" onclick="return confirm('Voulez-vous supprimer?')">Supprimer</i></td>
 					
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
          echo ' <a href="Abonnement.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</h6>'; 
 		}else{
 			echo "votre rapport n existe pas";
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