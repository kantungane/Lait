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
	<?php require "../Header.php"; ?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
	<h3 style="margin-left: 600px;">Formulaire de modification du Travailleur</h3>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button style=" margin-left:300px;" id="recharger" onclick="recharger()">Recharger</button> </center>
<form method="POST">
	
<label class="form-label" >Nom</label>
<input class="form-control" type="text" name="nom" id="nom"><br>
<label class="form-label">Prenom</label>
<input class="form-control" type="text" name="prenom" id="prenom"><br>
<label class="form-label">CNI</label>
<input class="form-control" type="text" name="cni" id="cni"><br>
<label class="form-label" >categorie du Travailleur</label>
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
<label class="form-label">Adresse</label>
<input class="form-control" type="text" name="adresse" id="adresse"><br>

<label class="form-label">Telephone</label>
<input class="form-control" type="text" name="tele" id="tele"><br>	
<input class="form-control" type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; ">

</form>
</center>

<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Travailleurs WHERE Id_Travailleur=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
						document.getElementById("nom").value="<?php echo $ligne['Nom'];?>"
						document.getElementById("prenom").value="<?php echo $ligne['Prenom'];?>"
						document.getElementById("cni").value="<?php echo $ligne['CNI'];?>"
					document.getElementById("categorie").value="<?php echo $ligne['Categorie_Travailleur'];?>"
						document.getElementById("adresse").value="<?php echo $ligne['Adresse'];?>"
						
						document.getElementById("tele").value="<?php echo $ligne['Tel'];?>"
						
						}
				</script>
			<?php 
			}
		}                 
if (isset($_POST['submit'])){
  $nom=htmlspecialchars($_POST['nom']);
   $prenom=htmlspecialchars($_POST['prenom']);
   $cni=htmlspecialchars($_POST['cni']);
    $categorie=htmlspecialchars($_POST['categorie']);
	$adresse=htmlspecialchars($_POST['adresse']);
	
     $phone=htmlspecialchars($_POST['tele']);
     $date=date('y-m-d');
     $statut='1';
    if(!empty( $_POST['nom']) AND !empty( $_POST['prenom']) AND !empty( $_POST['cni']) AND !empty($_POST['categorie']) AND !empty( $_POST['adresse']) AND !empty($_POST['tele'])){
  $inser=$pdo->prepare("UPDATE Travailleurs SET Nom=?,Prenom=?,CNI=?,Categorie_Travailleur=?,Adresse=?,Tel=? WHERE Id_Travailleur=?");
   $inser->execute(array($nom,$prenom,$cni,$categorie,$adresse,$phone,$id));
   
   	 $succes= "Modification réussie";
  

 }else{
 	$succes= "Veuiller completer tous les champs!";
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