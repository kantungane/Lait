<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un Client</title>
	<meta charset="utf-8">
	<style type="text/css">
		
		
		form{
			width: 700px;
			height:auto;
			margin-left: 600px;
		}
		
	</style>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>
</head>
<body>
	<?php 
	ob_start();
	require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire d'enregistrement des Travailleurs</h3>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 620px; margin-top: -640px;">

<form method="POST">
	
<label class="form-label">Nom</label><br>
<input class="form-control" type="text" name="nom"><br>
<label class="form-label">Prenom</label><br>
<input class="form-control" type="text" name="prenom"><br>
<label class="form-label">CNI</label><br>
<input class="form-control" type="text" name="cni"><br>

<select class="form-select" name="categorie"id="categorie">
	<?php  $conn = $pdo ->prepare("SELECT Distinct(Designation) FROM Categorie_Travailleurs ");
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
<label class="form-label">Adresse</label><br>
<input class="form-control" type="text" name="adresse"><br>

<label class="form-label">Telephone</label><br>
<input class="form-control" type="text" name="tele"><br>

	
<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; ">

</form>
<?php    
if (isset($_POST['submit'])){
if(!empty( $_POST['nom']) AND !empty( $_POST['prenom']) AND !empty( $_POST['cni']) AND !empty($_POST['categorie']) AND !empty( $_POST['adresse']) AND !empty($_POST['tele'])){
  $nom=htmlspecialchars($_POST['nom']);
   $prenom=htmlspecialchars($_POST['prenom']);
   $cni=htmlspecialchars($_POST['cni']);
    $categorie=htmlspecialchars($_POST['categorie']);
	$adresse=htmlspecialchars($_POST['adresse']);
	
     $phone=htmlspecialchars($_POST['tele']);
     $date=date('y-m-d');
     $statut='1';
    

   	$conn = $pdo ->prepare("SELECT * FROM Travailleurs WHERE Nom=? AND Prenom=? ");
		$conn->execute(array($nom,$prenom));
			$row=$conn->rowcount();
			if($row<=0){ 	
  $inser=$pdo->prepare("INSERT INTO Travailleurs(Nom,Prenom,CNI,Categorie_Travailleur,Adresse,Tel,Statut,Date_enreg)VALUES(?,?,?,?,?,?,?,?)");
   $inser->execute(array($nom,$prenom,$cni,$categorie,$adresse,$phone,$statut,$date));
   
   	 $succes= "Inscription réussie";
  	header('Location:../Home/Travailleur.php');
	}else{
 	$error= "Ce Travailleur est déjà inscrit,Veuiller renommer le nouveau Travailleur!";
 	}
 }else{
 	$error= "Veuiller completer tous les champs!";
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