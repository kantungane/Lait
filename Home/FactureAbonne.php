<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		a{
			text-decoration:none; 
			color: steelblue;
		}
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


</head>
<body>
	<?php 
	require("../Header.php");
	if(isset($_SESSION['username'])){
?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
<center><h3>Paiement des abonnés</h3></center>
</div>
	

	
<?php 

	require("../Side/database.php");

$id=$_GET['id'];

$retour_total=$pdo->prepare("SELECT * FROM Paiements WHERE Id_Paiement =?");
$retour_total->execute(array($id)); 
$total=$retour_total->rowcount();
 if ($total>0) {
 			
 		?>
 		<div id="section" style="border: 1px solid black;width: 900px;margin-left: 400px;">
 		<center><h2>Facture de paiement</h2></center>
 		<?php	
 			
 setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
while($repo=$retour_total->fetch(PDO::FETCH_ASSOC)) 
{				
				$date2=$repo['Date_Paiement'];
 				$datepay = utf8_encode(strftime("%d %B %Y", strtotime($date2)));
 				?>
 			
 					<div style="margin-left: 20px;">
 					<h3>Nom du Client: <?php  echo  $repo['Nom_Client'] ;?></h3>
 					<h3 style="margin-left: 600px;margin-top: -40px;">    Le <?php  echo $datepay;?></h3>
 					<h3>Prenom: <?php  echo $repo['Prenom'];?></h3>
 					<h3>Categorie: <?php  echo $repo['Categorie_Abonne'];?></h3>
 					<h3>Categorie du produit:<?php  echo  $repo['Nom_Produit'] ;?></h3>
 					<h3>Montant à payer: <?php  echo $repo['Montant'];?> fbu</h3>
 					<h3>Cash payé: <?php  echo $repo['Cash'];?> fbu</h3>
 					<h3>Montant restant: <?php  echo $repo['Reste'];?> fbu</h3>
 					<h3>Periode fournie: <?php  echo  $repo['Periode_Livraison'] ;?></h3>
 					
 					<br>
 					<br>
 					<h3>Signature du Fournisseur:...................</h3>
 					<h3 style="margin-left: 500px;margin-top: -40px;">Signature du du client:.....................</h3>
 					<br>
 				</div><br>
 				</div>
 				<br>
 				<button style="margin-left: 400px;" onclick="imprimer()">Imprimer</button><button style="margin-left: 500px;"><a href="PaiementDesAbonnes.php" >Retour à la liste</a></button>
 <script type="text/javascript">
 	function imprimer(){
 		var printcontents = document.getElementById('section').innerHTML;
 		var orginalcontents =document.body.innerHTML;
 		document.body.innerHTML = printcontents;
 		window.print();
 		document.body.innerHTML = orginalcontents;
 	}
 </script>
 				<?php 	
 			}
 		
 				

 		}else{
 			echo "votre rapport n'existe pas";
 		}
 }else{
 		?>
 		<center><p style= "color: red;letter-spacing: 1px;" > Vous n'etes pas connectés!! <a href="../Index.php">Connectez-vous</a></p></center>
 		<?php
 	}
  ?>
 	
<?php
 require("../Footer.php");
?>
 </body>
</html>