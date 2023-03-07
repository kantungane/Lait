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
	<h3 style="margin-left: 600px;">Formulaire de modification de l'abonné</h3>
</div>

<?php
 require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>

<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button style=" margin-left:300px;" id="recharger" onclick="recharger()">Recharger</button> </center><br>
<form method="POST">
	
<label  class="form-label">Nom</label><br>
<select  class="form-select"name="nom"id="nom">
	<?php  $conn = $pdo ->prepare("SELECT * FROM Clients ");
			$conn->execute(array());
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {
			 	 ?>
			 	<option> <?php echo $lign["Nom"]; ?></option>
			 <?php	
				}
			}
			 ?>
</select>

<br>
<label>Prenom</label><br>
<select  class="form-select"name="prenom"id="prenom">
	<?php  $conn = $pdo ->prepare("SELECT * FROM Clients ");
			$conn->execute(array());
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {
			 	 ?>
			 	<option> <?php echo $lign["Prenom"]; ?></option>
			 <?php	
				}
			}
			 ?>
</select>
<br>

<label>Categorie d'Abonnement</label><br>
<select  class="form-select" name="categorie"id="categorie">
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
<br>
<label>Nom du Produit</label><br>
<select  class="form-select" name="produit"id="produit">
	<?php  $conn = $pdo ->prepare("SELECT Distinct(Nom_Produit) FROM Categorie_Abonnes ");
			$conn->execute(array());
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {
			 	 ?>
			 	<option> <?php echo $lign["Nom_Produit"]; ?></option>
			 <?php	
				}
			}
			 ?>
</select>
<br>
<label>Date Debut</label><br>
<input  class="form-control" type="date" name="debut" id="debut"><br>
<label>Date Fin</label><br>
<input  class="form-control" type="date" name="fin" id="fin" readonly="readonly"><br>

<input type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; "><br>

</form>
<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Abonnements WHERE Id_Abonnement=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
						document.getElementById("nom").value="<?php echo $ligne['Nom_Client'];?>"
						document.getElementById("prenom").value="<?php echo $ligne['Prenom'];?>"
						document.getElementById("categorie").value="<?php echo $ligne['Categorie_Abonne'];?>"
						
						document.getElementById("produit").value="<?php echo $ligne['Nom_Produit'];?>"
						document.getElementById("debut").value="<?php echo $ligne['Date_Debut'];?>"
						document.getElementById("fin").value="<?php echo $ligne['Date_Fin'];?>"
						}
				</script>
			<?php 
			}
		}           
    
if (isset($_POST['submit'])){
  $nom=htmlspecialchars($_POST['nom']);
   $prenom=htmlspecialchars($_POST['prenom']);
   $categorie=htmlspecialchars($_POST['categorie']);
   $produit=htmlspecialchars($_POST['produit']);
	$debut=htmlspecialchars($_POST['debut']);
	$time=date('y-m-d');
	$conn = $pdo ->prepare("SELECT * FROM Calendriers WHERE Categorie_Abonne=?");
			$conn->execute(array($categorie));
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC))
			 {
			 	$nombre=$lign['Nombre'];
			 	$periode=$lign['Periode'];	
				}
			}
					$validity=$nombre.$periode;
					$date= new DateTime($debut);
					$date->modify($validity);
					$fin=$date->format('y-m-d');
	
  if(!empty( $_POST['nom']) AND !empty( $_POST['prenom']) AND !empty( $_POST['categorie'])  AND !empty( $_POST['produit']) AND !empty($_POST['debut'])){
  $inser=$pdo->prepare("UPDATE Abonnements SET Nom_Client=?,Prenom=?,Categorie_Abonne=?,Nom_Produit=?,Date_Debut=?,Date_Fin=? WHERE Id_Abonnement=?");
   $inser->execute(array($nom,$prenom,$categorie,$produit,$debut,$fin,$id));
   
   	 $succes= "Modification réussie";
  	
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
?>
</body>
</html>