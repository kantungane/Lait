
<?php 
	
	require("../Side/database.php");
	setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
 		$debut =$_GET["debut"];
		$fin =$_GET["fin"];
 		$nom =$_GET["nom"];
		$prenom =$_GET["prenom"];
		if(!empty($debut) AND !empty($fin) AND !empty( $nom)  AND !empty( $prenom)){
		
		
		$repons=$pdo->prepare("SELECT * FROM Ventes  WHERE Nom_Client= ? AND Prenom = ? AND Date_Vente >= ? AND Date_Vente <= ? ORDER BY Id_Vente DESC");
 		$repons->execute(array($nom,$prenom,$debut,$fin));
 		$row=$repons->rowcount();
 		if ($row>0) {
 			$debutencod = utf8_encode(strftime("%d %B %Y", strtotime($debut)));
 			$finencod = utf8_encode(strftime("%d %B %Y", strtotime($fin)));
 			?>
 			<center><h2><?php echo "Vente effectuée chez ";echo $nom;echo " ";echo $prenom;echo" depuis "; echo $debutencod;echo " jusqu'au ";echo $finencod;?></h2></center>
 			 <table class="table table-striped table-hover table-bordered table-sm">
 			 	 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Categorie</th><th>Produit</th><th>Montant</th><th>Periode de Livraison</th><th>Date de Vente</th><th>Date de Paiement</th><th>Etat de Paiement</th>
 			 	</tr>
 			 </thead>
 			 <?php
 			 $quantite=0;
 			 $Sum=0;
 			while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 				$quantite=$quantite+ $repo['Quantite'];
 				$Sum=$Sum+ $repo['Montant'];
 				$date1=$repo['Date_Vente'];
 				$dateVente = utf8_encode(strftime("%d %B %Y", strtotime($date1)));
 				$date2=$repo['Date_Paiement'];
 				$datePay = utf8_encode(strftime("%d %B %Y", strtotime($date2)));
 				?>
 				<tr>
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					<td> <?php  echo $repo['Categorie_Abonne'];?></td>
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $repo['Montant'];?></td>
 					<td> <?php  echo  $repo['Periode_Livraison'] ;?></td>
 					<td> <?php  echo $dateVente;?></td>
 					<td> <?php  echo $datePay;?></td>
 					<td> <?php  echo $repo['Etat_Paiement'];?></td>
 				</tr>
 				<?php 	
 			}
 			?>
 			<tr><?php echo $quantite;echo" Litres du lait sont Vendus à ";echo $Sum;echo" fbu";?></tr>
 			
 				</table>
 				</center>
 				<?php 
 		}else{
 			echo "Selectionner les données valides";
 		}
 }else{
 			echo "Selectionner les données valides";
 		}
  ?>
 </body>
</html>