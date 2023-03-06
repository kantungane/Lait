
<?php 
	
	require("../Side/database.php");
		setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
		$debut =$_GET["debut"];
		$fin =$_GET["fin"];
 		$nom =$_GET["nom"];
		$prenom =$_GET["prenom"];
		if(!empty($debut) AND !empty($fin) AND !empty( $nom)  AND !empty( $prenom)){
		
		
		$repons=$pdo->prepare("SELECT * FROM Paiements WHERE Nom_Client= ? AND Prenom = ? AND Date_Paiement >= ? AND Date_Paiement <= ? ORDER BY Id_Paiement DESC");
 		$repons->execute(array($nom,$prenom,$debut,$fin));
 		$row=$repons->rowcount();
 		if ($row>0) {
 			$debutencod = utf8_encode(strftime("%d %B %Y", strtotime($debut)));
 			$finencod = utf8_encode(strftime("%d %B %Y", strtotime($fin)));
 			?>
 			<center><h2><?php echo "Paiement effectué par ";echo $nom;echo " ";echo $prenom;echo" depuis "; echo $debutencod;echo " jusqu'au ";echo $finencod;?></h2></center>
 			 <table class="table table-striped table-hover table-bordered table-sm">
 			 	 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Categorie</th><th>Produit</th><th>Montant</th><th>Cash</th><th>Reste</th><th>Periode de Livraison</th><th>Date de Paiement</th>
 			 	</tr>
 			 </thead>
 			 <?php
 			 $Sum=0;
 			while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 				$Sum=$Sum+ $repo['Cash'];
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
 			?><tr>Somme: <?php  echo $Sum;?></tr>
 				</table>
 				</center>
 				<?php 
 		}else{
 			echo "Il n'y a pas de rapport, Veuiller selectionner les données valides";
 		}
 }else{
 			echo "Selectionner les données valides";
 		}
  ?>
 </body>
</html>