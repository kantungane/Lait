<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		
		button{
			width: 200px;
			height:40px;
			font-size: 15px;
			margin-left: 5px;
			margin-bottom: 10px;
			background: rgb(0,10,10);
			color: ivory;
		}
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
<center><h3>Liste des Clients Redevables</h3></center>
</div>
	
<?php 
	require("../Side/Sidebar.php");
	require("../Side/database.php");
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
		$times=date('y-m-d');
 		$repons=$pdo->prepare("SELECT Nom_Client,Prenom,Nom_Produit,SUM(Montant) As Somme,Periode_Livraison FROM Ventes WHERE Etat_Paiement=?  AND Categorie_Abonne!=? AND Date_Paiement<=? GROUP BY Periode_Livraison");
 		$repons->execute(array('Non','null',$times));
 		$row=$repons->rowcount();
 		if ($row>0) {
 			?>
 			
 			<div class="container" style="height: 640px; margin-top: -665px;margin-left:350px;overflow-y: scroll;position: relative;">
 				<button class="btn"><a href="PaiementAbonnes.php">Paiement des Abonnés</a></button>
 			<button class="btn"><a href="PaiementdesAcheteurs.php">Paiement Des Acheteurs</a></button>	
 			<button class="btn"><a href="PaiementTemporel.php">Paiement Temporel</a></button>
 			<button class="btn"><a href="PayPersonnel.php">Paiement Personnel</a></button>
			<div id="section">
				<center><h3>Clients redevables</h3></center><br>
 			 <table class="table table-striped table-hover table-bordered">
 			 	 <thead class="table-light">
 			 	<tr>
 			 		<th>Nom</th><th>Prenom</th><th>Produit</th><th>Montant</th><th>Periode de Livraison</th>
 			 	</tr>
 			 </thead>
 			 <?php
 			while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 				?>
 				<tr>
 					<td> <?php  echo  $repo['Nom_Client'] ;?></td>
 					<td> <?php  echo $repo['Prenom'];?></td>
 					
 					<td> <?php  echo  $repo['Nom_Produit'] ;?></td>
 					<td> <?php  echo $repo['Somme'];?></td>
 					<td> <?php  echo  $repo['Periode_Livraison'] ;?></td>
 					
 				</tr>
 				<?php 	
 			}
 			?>
 				</table>
 		
 			</div>
 				<?php 
 		}else{
 			echo "Aucun Client redevable";
 		}
 }else{
 		?>
 		<center><p style= "color: red;letter-spacing: 1px;" > Vous n'etes pas connectés!! <a href="../Index.php">Connectez-vous</a></p></center>
 		<?php
 	}
  ?>
 <button onclick="imprimer()">Imprimer</button>
 <script type="text/javascript">
 	function imprimer(){
 		var printcontents = document.getElementById('section').innerHTML;
 		var orginalcontents =document.body.innerHTML;
 		document.body.innerHTML = printcontents;
 		window.print();
 		document.body.innerHTML = orginalcontents;
 	}
 </script>
</div>
<?php
 require("../Footer.php");
?>
</body>
</html>