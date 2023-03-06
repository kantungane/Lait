<!DOCTYPE html>
<html>
<head>
	<title>Ajouter une Depense</title>
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
	<h3 style="margin-left: 600px;">Formulaire d'enregistrement des Depenses</h3>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 620px; margin-top: -640px;">

<form method="POST">
<label class="form-label">Categorie</label><br>
<select class="form-select" name="categorie"id="categorie">
	<?php  $conn = $pdo ->prepare("SELECT Distinct(Designation) FROM Categorie_Depenses ");
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
</select>	<br><br>
<label class="form-label">Montant</label><br>
<input class="form-control" type="number" name="montant"><br><br>

<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:100px; ">

</form>
<?php    
if (isset($_POST['submit'])){
 
    $categorie=htmlspecialchars($_POST['categorie']);
	$montant=htmlspecialchars($_POST['montant']);
	
     $date=date('y-m-d');
    
    if(!empty( $_POST['categorie']) AND !empty( $_POST['montant'])){
  $inser=$pdo->prepare("INSERT INTO Depenses(Categorie_Depense,Montant,Date_enreg)VALUES(?,?,?)");
   $inser->execute(array($categorie,$montant,$date,));
   
   	 $succes= "Enregistrement réussie";
  	header('Location:../Home/Depense.php');

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