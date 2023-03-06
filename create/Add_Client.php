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
	<h3 style="margin-left: 600px;">Formulaire d'enregistrement des Clients</h3>
</div>

<?php
 
require("../Side/database.php");
require("../Side/Sidebar.php");
	?>

<div style=" height: 620px; margin-top: -640px;">

<form method="POST">
	
<label class="form-label">Nom</label><br>
<input class="form-control" type="text" name="nom"><br><br>
<label class="form-label">Prenom</label><br>
<input class="form-control" type="text" name="prenom"><br><br>


<label class="form-label">Adresse</label><br>
<input class="form-control" type="text" name="adresse"><br><br>

<label class="form-label">Telephone</label><br>
<input class="form-control" type="text" name="tele"><br><br>

<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; "><br><br>

</form>


<?php    
if (isset($_POST['submit'])){
if(!empty( $_POST['nom']) AND !empty( $_POST['prenom'])  AND !empty( $_POST['adresse']) AND !empty($_POST['tele'])){
  $nom=htmlspecialchars($_POST['nom']);
   $prenom=htmlspecialchars($_POST['prenom']);
   
	$adresse=htmlspecialchars($_POST['adresse']);
	
     $phone=htmlspecialchars($_POST['tele']);
    
     $statut='1';
      $data=date('y-m-d');

    
    	$conn = $pdo ->prepare("SELECT * FROM Clients WHERE Nom=? AND Prenom=? ");
		$conn->execute(array($nom,$prenom));
			$row=$conn->rowcount();
			if($row<=0){
			
			
  $inser=$pdo->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Tel,Statut,Date_enreg)VALUES(?,?,?,?,?,?)");
   $inser->execute(array($nom,$prenom,$adresse,$phone,$statut,$data));
   
   	 $succes= "Inscription réussie";
  	header("Location:../Home/Client.php"); 
  	}else{
 	$error= "Ce Client est déjà inscrit,Veuiller renommer le nouveau Client";
 	}

 }else{
 	$error= "Veuiller completer tous les champs!";
 	}
 
 }
 
?>
<center><h3 style="color:teal;"><?php if(isset($succes)){echo $succes;}?></h3></center>
<center><h3 style="color:red;"><?php if(isset($error)){echo $error;}?></h3></center><br>
</div>
<?php
 require("../Footer.php");
 ob_end_flush();
?>
</body>
</html>