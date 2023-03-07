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
	<script src="../Lib/mainVenteAuxAbo.js"type="text/javascript"></script>
</head>
<body>
	<?php require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire de modification de Vente Aux Abonnés</h3>
</div>

<?php
ob_start();
require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button id="recharger" onclick="recharger()">Recharger</button> </center><br>
<form method="POST">
<div style="width: 400px;margin-left: 400px;">
<label class="form-label">Categorie d'Abonné</label><br>	
<select class="form-select" name="categorie"id="categorie">
	<?php  $cate = $pdo ->prepare("SELECT Distinct(Designation) FROM Categorie_Abonnes ");
			$cate->execute(array());
			$row=$cate->rowcount();
			if($row>0){
			
			while($lign=$cate->fetch(PDO::FETCH_ASSOC))
			 {
			 	$categorie=$lign["Designation"];
			 	
			 	 ?>
			 	<option> <?php echo $categorie; ?></option>
			 <?php	
				}
			}
			 ?>
</select><br>		
<label class="form-label">Nom</label><br>
<input class="form-control" type="text" name="nom" id="nom"><br>
<label class="form-label">Prenom</label><br>
<input class="form-control" type="text" name="prenom" id="prenom"><br>


<label class="form-label">Prix Unitaire</label><br>
<input class="form-control" type="number" name="unitaire" id="unitaire"><br>

<label class="form-label">Quantite</label><br>
<input class="form-control" type="number" name="quantite" id="quantite"><br>
</div>

<div style="margin-left: 1000px;margin-top: -470px;width: 500px;">
<label class="form-label">Montant</label><br>
<input class="form-control" type="number" name="montant" id="montant" readonly="readonly"><br>

<label class="form-label">Periode de Livraison</label><br>
<input class="form-control" type="text" name="periode" id="periode"><br>

<label class="form-label">Date de Vente</label><br>
<input class="form-control" type="date" name="dateVente" id="dateVente"><br>

<label class="form-label">Date de Paiement</label><br>
<input class="form-control" type="date" name="datePay" id="datePay"><br>

<br>	
<input class="form-control" type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:150px; ">
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
						document.getElementById("categorie").value="<?php echo $ligne['Categorie_Abonne'];?>"
						document.getElementById("nom").value="<?php echo $ligne['Nom_Client'];?>"
						document.getElementById("prenom").value="<?php echo $ligne['Prenom'];?>"
						document.getElementById("unitaire").value="<?php echo $ligne['Prix_Unitaire'];?>"
						document.getElementById("quantite").value="<?php echo $ligne['Quantite'];?>"
						document.getElementById("montant").value="<?php echo $ligne['Montant'];?>"
						document.getElementById("periode").value="<?php echo $ligne['Periode_Livraison'];?>"
						document.getElementById("dateVente").value="<?php echo $ligne['Date_Vente'];?>"
						document.getElementById("datePay").value="<?php echo $ligne['Date_Paiement'];?>"
						
						}
				</script>
			<?php 
			}
		}       
if (isset($_POST['submit'])){
		$categorie=htmlspecialchars($_POST['categorie']);
 	 	$nom=htmlspecialchars($_POST['nom']);
 	 	 $prenom=htmlspecialchars($_POST['prenom']);
   
		$unitaire=htmlspecialchars($_POST['unitaire']);
		$quantite=htmlspecialchars($_POST['quantite']);
     	$montant=htmlspecialchars($_POST['montant']);
     	$periode=htmlspecialchars($_POST['periode']);
    	$dateVente=htmlspecialchars($_POST['dateVente']);
    	$datePay=htmlspecialchars($_POST['datePay']);
    	$statut='Non';

    	 $conn = $pdo ->prepare("SELECT * FROM Abonnements WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? ");
			$conn->execute(array($categorie,$nom,$prenom));
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {	$produit=$lign["Nom_Produit"];
			 	
				}
			

   if(!empty( $_POST['categorie']) AND!empty( $_POST['nom']) AND !empty( $_POST['prenom'])  AND !empty( $_POST['unitaire']) AND !empty( $_POST['quantite']) AND!empty( $_POST['montant']) AND !empty( $_POST['dateVente'])){

  $inser=$pdo->prepare("UPDATE Ventes SET Categorie_Abonne=?,Nom_Client=?,Prenom=?,Nom_Produit=?,Prix_Unitaire=?,Quantite=?,Montant=?,Periode_Livraison=?,Etat_Paiement=?,Date_Vente=?,Date_Paiement=? WHERE Id_Vente=?");
   $inser->execute(array($categorie,$nom,$prenom,$produit,$unitaire,$quantite,$montant,$periode,$statut,$dateVente,$datePay,$id));
   
   	 $succes= "Modification réussie";
  	header('Location:../Home/VenteAuxAbonnes.php');

 }else{
 	$error= "completer tous les champs";
 }

  }else{
 	$error= "Vous n'etes pas abonnés dans cette categorie!";
 }
 }
?>
<center><h3 style="color:teal;"><?php if(isset($succes)){echo $succes;}?></h3></center>
<center><h3 style="color:red;"><?php if(isset($error)){echo $error;}?></h3></center>
</div>
<?php
 require("../Footer.php");
 ob_end_flush();
?>
</body>
</html>