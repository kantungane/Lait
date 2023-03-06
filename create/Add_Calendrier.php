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
	<h3 style="margin-left: 600px;">Formulaire de fixation du calendrier</h3>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 620px; margin-top: -640px;">

<form method="POST">
	


<label class="form-label">Categorie d'Abonnement</label><br>
<select class="form-select" name="categorie"id="categorie">
	<?php  $conn = $pdo ->prepare("SELECT Distinct(Designation) FROM Categorie_Abonnes ");
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
</select>
	
<label class="form-label">Periode d'Abonnement</label><br>
<select class="form-select" name="periode"id="periode">
	
			 	<option value="day">Jour</option>
			 	<option value="week">Semaine</option>
			 	<option value="month">Mois</option>

</select>

<br>
<label class="form-label">Nombre</label><br>
<input class="form-control" type="number" name="nombre"><br>

	
<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; "><br><br>

</form>

</div>
<?php    
if (isset($_POST['submit'])){
  $categorie=htmlspecialchars($_POST['categorie']);
   $periode=htmlspecialchars($_POST['periode']);
    $nombre=htmlspecialchars($_POST['nombre']);


 

 if(!empty( $_POST['categorie']) AND !empty( $_POST['periode']) AND !empty($_POST['nombre'])){
  $inser=$pdo->prepare("INSERT INTO Calendriers(Categorie_Abonne,Periode,Nombre)VALUES(?,?,?)");
   $inser->execute(array($categorie,$periode,$nombre));
   
   	 $succes= "Inscription réussie";
  	header('Location:../Home/Calendrier.php');

 }else{
 	$error= "completer tous les champs";
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