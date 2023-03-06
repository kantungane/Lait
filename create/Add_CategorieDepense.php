<!DOCTYPE html>
<html>
<head>
	<title>Add_Categorie</title>
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
	<h3 style="margin-left: 600px;">Formulaire d'ajout des categories de Depenses</h3>
</div>
<?php
require("../Side/Sidebar.php");
require("../Side/database.php");
	?>
<div style=" height: 620px; margin-top: -640px;">

<form method="POST">
	
<label class="form-label">Nom de la Categorie</label><br>
<input class="form-control" type="text" name="nom_category"><br>

<br>	
<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; ">

</form>
<?php    
if (isset($_POST['submit'])){
  $nom=htmlspecialchars($_POST['nom_category']);
	
       if ( !empty( $_POST['nom_category']) ){
  $inser=$pdo->prepare("INSERT INTO Categorie_Depenses(Designation)VALUES(?)");
   $inser->execute(array($nom));
   
   	 $succes= "Inscription réussie";
 	header('Location:../Home/CategorieDepense.php');

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