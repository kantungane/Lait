
<?php 
	
	require("../Side/database.php");
		setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
 		$debut =$_GET["debut"];
		$fin =$_GET["fin"];
		$repons=$pdo->prepare("SELECT * FROM Ventes WHERE Date_Vente >= ? AND Date_Vente <= ?");
 		$repons->execute(array($debut,$fin));
 		$row=$repons->rowcount();
 		if ($row>0) {
 			$debutencod = utf8_encode(strftime("%d %B %Y", strtotime($debut)));
 			$finencod = utf8_encode(strftime("%d %B %Y", strtotime($fin)));
 			?>
 			<center><h2><?php echo "Ventes effectués depuis ";echo $debutencod;echo " jusqu'au ";echo $finencod;?></h2></center>
 			 <table class="table table-striped table-hover table-bordered table-sm">
 			 	 <thead class="table-light">
 			 	<tr>
 			 		<th>ID</th><th>Nom</th><th>Prenom</th><th>Categorie</th><th>Produit</th><th>Montant</th><th>Date de Vente</th><th>Date de Paiement</th><th>Etat de Paiement</th>
 			 	</tr>
 			 </thead>
 			 <?php
 			while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 				?>
 				<tr>
 					<td> <?php echo $repo['Id_Vente'];?></td>
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					<td> <?php  echo $repo['Categorie_Abonne'];?></td>
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $repo['Montant'];?></td>
 					
 					<td> <?php  echo $repo['Date_Vente'];?></td>
 					<td> <?php  echo $repo['Date_Paiement'];?></td>
 					<td> <?php  echo $repo['Etat_Paiement'];?></td>
 				</tr>
 				<?php 	
 			}
 			?>
 				</table>
 				</center>
 				<?php 
 		}else{
 			echo "votre rapport n'existe pas";
 		}
 
  ?>
 </body>
</html>