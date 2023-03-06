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
<center><h3>Paiement des Abonnés</h3></center>
</div>

<?php 
    require("../Side/Sidebar.php");
    require("../Side/database.php");
    setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

$messagesParPage=120; 
$retour_total=$pdo->prepare("SELECT * FROM Paiements"); 
$retour_total->execute(array()); 
$total=$retour_total->rowcount();
 if ($total>0) {
 			?>
 			
 	<div class="container" style="height: 640px; margin-top: -665px;margin-left:350px;overflow-y: scroll;position: relative;" id="section">
            <button class="btn"><a href="PaiementdesAcheteurs.php">Paiement Des Acheteurs</a></button>
 			<button class="btn"><a href="PaiementTemporel.php">Paiement Temporel</a></button>
 			<button class="btn"><a href="PayPersonnel.php">Paiement Personnel</a></button>
			<button class="btn"><a href="RapportRedevable.php">Liste des Redevable</a></button>
 			 <table class="table table-striped table-hover table-bordered">
 			 	 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Categorie</th><th>Produit</th><th>Montant</th><th>Cash</th><th>Reste</th><th>Periode de Livraison</th><th>Date de Paiement</th>
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
$categorie="null"; 
$retour_messages=$pdo->prepare("SELECT  * FROM Paiements WHERE Categorie_Abonne!=? ORDER BY Id_Paiement DESC LIMIT ?,?");
$retour_messages->execute(array($categorie,$premiereEntree,$messagesParPage));
 
while($repo=$retour_messages->fetch(PDO::FETCH_ASSOC)) 
{

 				$date1=$repo['Date_Paiement'];
 				$date = utf8_encode(strftime("%d %B %Y", strtotime($date1)));
 				?>
 				<tr>
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					<td> <?php  echo $repo['Categorie_Abonne'];?></td>
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $repo['Montant'];?></td>
 					<td> <?php  echo $repo['Cash'];?></td>
 					<td> <?php  echo $repo['Reste'];?></td>
 					<td> <?php  echo  $repo['Periode_Livraison'] ;?></td>
 					<td> <?php  echo $date;?></td>
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
          echo ' <a href="RapportPaiement.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</h6>';

 		}else{
 			echo "votre rapport n'existe pas";
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