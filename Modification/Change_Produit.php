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
	<h3 style="margin-left: 600px;">Formulaire de modification du produit</h3>
</div>
<?php
require("../Side/Sidebar.php");
	require("../Side/database.php");
	?>
<div style=" height: 625px; margin-top: -650px; overflow: scroll;">
<center><button style=" margin-left:300px;" id="recharger" onclick="recharger()">Recharger</button> </center><br>

<form method="POST" ><br>
	
<label class="form-label">Nom du Produit</label><br>
<input class="form-control" type="text" name="produit" id="produit"><br><br>	
<input class="form-control" type="submit" name="submit" value="Enregistrement" style="width:200px;background: teal; margin-left:300px; ">

</form>
<?php 
$id=$_GET['id'];
		$compte=$pdo-> prepare("SELECT * FROM Produits WHERE Id_Produit=?");
			$compte->execute(array($id));
			$row =$compte->rowcount();
			if($row > 0){
				while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
				?>
				<script type="text/javascript">
					function recharger(){
						document.getElementById("produit").value="<?php echo $ligne['Designation'];?>"
						
						
						}
				</script>
			<?php 
			}
		}                    
if (isset($_POST['submit'])){
  $nom=htmlspecialchars($_POST['produit']);
	
       if ( !empty( $_POST['produit']) ){
  $inser=$pdo->prepare("UPDATE Produits SET Designation=? WHERE Id_Produit=?");
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