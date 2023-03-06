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
	<?php
	ob_start();
	 require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire de Vente Aux Abonnés</h3>
</div>

<?php
require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 620px; margin-top: -640px;">

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
<input class="form-control" type="text" name="nom"><br>
<label class="form-label">Prenom</label><br>
<input class="form-control" type="text" name="prenom"><br>


<label class="form-label">Prix Unitaire</label><br>
<input class="form-control" type="number" name="unitaire" id="unitaire"><br>
</div>

<div style="margin-left: 1000px;margin-top: -375px;width: 500px;">
<label class="form-label">Quantite</label><br>
<input class="form-control" type="number" step="0.01" name="quantite" id="quantite"><br>

<label class="form-label">Montant</label><br>
<input class="form-control" type="number" name="montant" id="montant" readonly="readonly"><br>

<label class="form-label">Date de Vente</label><br>
<input class="form-control" type="date" name="date" id="date"><br><br>
	
<input class="form-control" type="submit" name="submit" value="Enregistrement" style="background: teal;">
</div>
</form>


<?php
  

if (isset($_POST['submit'])){
	 if(!empty( $_POST['categorie']) AND!empty( $_POST['nom']) AND !empty( $_POST['prenom'])  AND !empty( $_POST['unitaire']) AND !empty( $_POST['quantite']) AND!empty( $_POST['montant']) AND !empty( $_POST['date'])){
	 	
		$categorie=htmlspecialchars($_POST['categorie']);
 	 	$nom=htmlspecialchars($_POST['nom']);
 	 	 $prenom=htmlspecialchars($_POST['prenom']);
   
		$unitaire=htmlspecialchars($_POST['unitaire']);
		$quantite=htmlspecialchars($_POST['quantite']);
     	$montant=htmlspecialchars($_POST['montant']);
    	$date=htmlspecialchars($_POST['date']);
    	$statut='Non';
    	
    	 $conn = $pdo ->prepare("SELECT * FROM Abonnements WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? ");
			$conn->execute(array($categorie,$nom,$prenom));
			$row=$conn->rowcount();
			if($row>0){
			setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {	$produit=$lign["Nom_Produit"];
			 	$debut=$lign["Date_Debut"];
			 	$fin=$lign["Date_Fin"];

			 	$date1=$lign["Date_Debut"];
			 	$debutfr=utf8_encode(strftime("%d %B %Y", strtotime($date1)));
				$date2=$lign["Date_Fin"];
			 	$finfr=utf8_encode(strftime("%d %B %Y", strtotime($date2)));
			 	$periode=$debutfr." jusqu'au ".$finfr;
				}
			

  

  $inser=$pdo->prepare("INSERT INTO Ventes(Categorie_Abonne,Nom_Client,Prenom,Nom_Produit,Prix_Unitaire,Quantite,Montant,Periode_Livraison,Etat_Paiement,Date_Vente,Date_Paiement)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
   $inser->execute(array($categorie,$nom,$prenom,$produit,$unitaire,$quantite,$montant,$periode,$statut,$date,$fin));
   
   	  $succes= "Enregistrement réussie";
  	header('Location:../Home/VenteAuxAbonnes.php');


  }else{
 	$error= "Vous n'etes pas abonnés dans cette categorie!";
 }

 
 }else{
 	$error= "Veuillez completer tous les Champs";
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