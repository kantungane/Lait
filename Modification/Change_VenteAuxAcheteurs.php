<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un Client</title>
	<meta charset="utf-8">
	<style type="text/css">
		
		input{
		width: 400px;
	}
		
	</style>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>
	<script src="../Lib/mainVenteAuxAcha.js"type="text/javascript"></script>
</head>
<body>
	<?php require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire de modification Vente Aux Acheteurs</h3>
</div>

<?php
 	require("../Side/Sidebar.php");
	require("../Side/database.php");
?>
<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button id="recharger" onclick="recharger()">Recharger</button> </center><br>r>
<form method="POST" >
<div style="width: 400px;margin-left: 400px;">
<label class="form-label">Nom</label><br>
<input class="form-control" type="text" name="nom" id="nom"><br>
<label class="form-label">Prenom</label><br>
<input class="form-control" type="text" name="prenom" id="prenom"><br>

<label class="form-label">Produit</label><br>
<select class="form-select" name="produit"id="produit" id="produit">
	<?php  $conn = $pdo ->prepare("SELECT * FROM Produits ");
			$conn->execute(array());
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {
			 	 ?>
			 	<option> <?php echo $lign["Designation"]; ?></option>
			 <?php	
				}
			}
			 ?>
</select><br>

<label class="form-label">Prix Unitaire</label><br>
<input class="form-control" type="number" name="unitaire" id="unitaire"><br>

</div>

<div style="margin-left: 1000px;margin-top: -375px;width: 500px;">	
<label class="form-label">Quantite</label><br>
<input class="form-control" type="number" name="quantite" id="quantite"><br>

<label class="form-label">Montant</label><br>
<input class="form-control" type="number" name="montant" id="montant"><br>

<input type="hidden" name="Idvente" id="Idvente" readonly="readonly">

<label class="form-label">Date de Vente</label><br>
<input class="form-control" type="date" name="dateVente" id="dateVente"><br><br>

<input class="form-control" type="submit" id="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:150px; ">
</div>
</form>

<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Ventes WHERE Id_Vente=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
						document.getElementById("nom").value="<?php echo $ligne['Nom_Client'];?>"
						document.getElementById("prenom").value="<?php echo $ligne['Prenom'];?>"
						document.getElementById("produit").value="<?php echo $ligne['Nom_Produit'];?>"
						document.getElementById("unitaire").value="<?php echo $ligne['Prix_Unitaire'];?>"
						document.getElementById("quantite").value="<?php echo $ligne['Quantite'];?>"
						document.getElementById("Idvente").value="<?php echo $ligne['Periode_Livraison'];?>"
						document.getElementById("montant").value="<?php echo $ligne['Montant'];?>"
						document.getElementById("dateVente").value="<?php echo $ligne['Date_Vente'];?>"
						
						
						}
				</script>
			<?php 
			}
		}      
	if (isset($_POST['submit'])){
		$categorie="null";
 	 	$nom=htmlspecialchars($_POST['nom']);
 	 	 $prenom=htmlspecialchars($_POST['prenom']);
   		 $produit=htmlspecialchars($_POST['produit']);
		$unitaire=htmlspecialchars($_POST['unitaire']);
		$quantite=htmlspecialchars($_POST['quantite']);
     	$Idvente=htmlspecialchars($_POST['Idvente']);
     	$montant=htmlspecialchars($_POST['montant']);
    	$dateVente=htmlspecialchars($_POST['dateVente']);
    	
    	$statut='Oui';
		$periode="null";
		$cash=$montant;
		$reste=0;
		
   if(!empty( $_POST['nom']) AND !empty( $_POST['prenom']) AND !empty( $_POST['produit']) AND !empty( $_POST['unitaire']) AND !empty( $_POST['quantite']) AND!empty( $_POST['montant'])  AND!empty( $_POST['dateVente'])){
					
$inser=$pdo->prepare("UPDATE Ventes SET Categorie_Abonne=?,Nom_Client=?,Prenom=?,Nom_Produit=?,Prix_Unitaire=?,Quantite=?,Montant=?,Periode_Livraison=?,Etat_Paiement=?,Date_Vente=?,Date_Paiement=? WHERE Id_Vente=?");
$inser->execute(array($categorie,$nom,$prenom,$produit,$unitaire,$quantite,$montant,$periode,$statut,$dateVente,$dateVente,$id));

  $insert=$pdo->prepare("UPDATE Paiements SET Categorie_Abonne=?,Nom_Client=?,Prenom=?,Nom_Produit=?,Montant=?,Cash=?,Reste=?,Periode_Livraison=?,Date_Paiement=? WHERE Periode_Livraison=?");
   $insert->execute(array($categorie,$nom,$prenom,$produit,$montant,$cash,$reste,$periode,$dateVente,$Idvente));

   
 $succes= "Modification réussie";


}else{
	$error="Veuillez completer tous les Champs";
	}
}
?>
<center><h3 style="color:teal;"><?php if(isset($succes)){echo $succes;}?></h3></center>
<center><h3 style="color:red;"><?php if(isset($error)){echo $error;}?></h3></center>
</div>
<?php
 require("../Footer.php");
?>
</body>
</html>