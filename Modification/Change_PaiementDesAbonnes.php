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
<script src="../Lib/mainChangeMontant.js"type="text/javascript"></script>
<script src="../Lib/mainChangeReste.js"type="text/javascript"></script>
</head>
<body>

	<?php
	ob_start();
	 require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire de modification de Paiement des Abonnés</h3></center>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button id="recharger" onclick="recharger()">Recharger</button> </center><br>
<form method="POST">
<input type="hidden" name="idpaiement" id="idpaiement">
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

<label class="form-label">Periode de Livraison</label><br>
<input class="form-control" name="periode"id="periode">
	
</div>
<div style="margin-left: 1000px;margin-top: -375px;width: 400px;">
<label class="form-label">Montant Mensuel</label><br>
<input class="form-control" type="number" name="montant" id="montant" readonly="readonly"><br>

<label class="form-label">Reste</label><br>
<input class="form-control" type="text" name="reste" id="reste" readonly="readonly"><br>

<label class="form-label">Cash à Payer</label><br>
<input class="form-control" type="number" name="cash" id="cash"><br><br>


	
<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:100px; ">
</div>
</form>

<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Paiements WHERE Id_Paiement=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
					document.getElementById("idpaiement").value="<?php echo $ligne['Id_Paiement'];?>"
						document.getElementById("categorie").value="<?php echo $ligne['Categorie_Abonne'];?>"
						document.getElementById("nom").value="<?php echo $ligne['Nom_Client'];?>"
						document.getElementById("prenom").value="<?php echo $ligne['Prenom'];?>"
						document.getElementById("periode").value="<?php echo $ligne['Periode_Livraison'];?>"
						document.getElementById("montant").value="<?php echo $ligne['Montant'];?>"
						document.getElementById("cash").value="<?php echo $ligne['Cash'];?>"
						document.getElementById("reste").value="<?php echo $ligne['Reste'];?>"
						
						
						}
				</script>
			<?php 
			}
		}           
if (isset($_POST['submit'])){
		$categorie=htmlspecialchars($_POST['categorie']);
 	 	$nom=htmlspecialchars($_POST['nom']);
 	 	 $prenom=htmlspecialchars($_POST['prenom']);
   		 $periode=htmlspecialchars($_POST['periode']);
		$montant=htmlspecialchars($_POST['montant']);
		$cash=htmlspecialchars($_POST['cash']);
     	$reste=htmlspecialchars($_POST['reste']);
    	$datePay=date('y-m-d');

    	 $product = $pdo ->prepare("SELECT * FROM Abonnements WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? ");
			$product->execute(array($categorie,$nom,$prenom));
			$row=$product->rowcount();
			if($row>0){
			
			while($lign=$product->fetch(PDO::FETCH_ASSOC))
			 {	$produit=$lign["Nom_Produit"];
			 	
				}
			
   if(!empty($_POST['categorie']) AND!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['periode'])  AND !empty($_POST['cash']) ){

   $Verif = $pdo ->prepare("SELECT SUM(Montant) As Somme FROM Ventes WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=? ");
			$Verif->execute(array($categorie,$nom,$prenom,$periode));
			$row=$Verif->rowcount();
			if($row>0){
			
			
if($reste>=0 ){

  $inser=$pdo->prepare("UPDATE Paiements SET Categorie_Abonne=?,Nom_Client=?,Prenom=?,Nom_Produit=?,Montant=?,Cash=?,Reste=?,Periode_Livraison=?,Date_Paiement=? WHERE Id_Paiement=?");
   $inser->execute(array($categorie,$nom,$prenom,$produit,$montant,$cash,$reste,$periode,$datePay,$id));
   
   	 $succes= "Modification réussie";
   	 header('Location:../Home/PaiementDesAbonnes.php');
   	 $payfin= $pdo->prepare("SELECT * FROM Paiements WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=? ");
				$payfin->execute(array($categorie,$nom,$prenom,$periode));
				while($lignepay=$payfin->fetch(PDO::FETCH_ASSOC)){
				$Restant= $lignepay['Reste'];
				if($Restant==0){
					$valide="Oui";
				$Updata= $pdo->prepare("UPDATE Ventes SET Etat_Paiement=? WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=? ");
				$Updata->execute(array($valide,$categorie,$nom,$prenom,$periode));
				} 
			 }

  	
  	}else{
 		$succes= "Vous Avez depasser le Montant de cette periode!";
 		}

 	}else{
 	$succes= "Vous n'avez rien vendu chez ce Client dans cette periode!";
 }

 }else{
 	$succes= "completer tous les champs";
 }
 }else{
 	$succes= "Vous n'etes pas abonnés dans cette categorie!";
 }
 }
?>
<center><h3 style="color:teal;"><?php if(isset($succes)){echo $succes;}?></h3></center>
<center><h3 style="color:red;"><?php if(isset($error)){echo $error;}?></h3></center>
</div>
<?php
 ob_end_flush();
 require("../Footer.php");
?>
</body>
</html>