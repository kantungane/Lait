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
	<?php require "../Header.php";?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">               
	<h3 style="margin-left: 600px;">Formulaire de modification de la categorie des Travailleurs</h3>
</div>
<?php
require("../Side/Sidebar.php");
require("../Side/database.php");
	?>
<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button style=" margin-left:300px;" id="recharger" onclick="recharger()">Recharger</button> </center><br>

<form method="POST">
	
<label class="form-label">Nom de la Categorie</label><br>
<input class="form-control" type="text" name="nom_category" id="categorie"><br><br>	
<input class="form-control" type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; "><br><br>

</form>
<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Categorie_Travailleurs WHERE Id_Categorie=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
						document.getElementById("categorie").value="<?php echo $ligne['Designation'];?>"
					
						
						}
				</script>
			<?php 
			}
		}           
if (isset($_POST['submit'])){
  $nom=htmlspecialchars($_POST['nom_category']);
	
       if ( !empty( $_POST['nom_category']) ){
  $inser=$pdo->prepare("UPDATE Categorie_Travailleurs SET Designation=? WHERE Id_Categorie=?");
   $inser->execute(array($nom,$id));
   
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