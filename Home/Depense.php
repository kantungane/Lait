<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		
		
	</style>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>

</head>
<body>
	<?php 
	require("../Header.php");
	if(isset($_SESSION['username'])){
?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
<center><h3>Liste des Depenses</h3></center>
</div>
	
<div style="background-image: radial-gradient(pink, ivory);">
		
<a href="../Create/Add_Depense.php" ><i class="fa-solid fa-circle-plus" style="margin-left: 1600px;font-size: 30px;"></i></a>
</div>
	
<?php 
	require("../Side/Sidebar.php");
	require("../Side/database.php");


 		$repons=$pdo->prepare("SELECT * FROM Depenses");
 		$repons->execute(array());
 		$row=$repons->rowcount();
 		if ($row>0) {
 			?>
 			
 			   <div class="table-responsive" style="height: 600px;overflow-y: scroll; margin-top: -650px;margin-left:350px; " id="section">
 			 <table class="table table-striped table-hover table-bordered table-sm">
 			 <thead class="table-light">
 			 	<tr>
 			 		<th>Categorie</th><th>Montant</th><th>Date d'Enregistrement</th><th>MODIFIER</th><th>SUPPRIMER</th>
 			 	</tr>
 			 </thead>
 			 <?php
 			while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 				?>
 				<tr>
 					
 					
 					<td> <?php echo $repo['Categorie_Depense'];?></td>
 					
 					<td> <?php  echo  $repo['Montant'] ;?></td>

 					<td> <?php  echo $repo['Date_enreg'];?></td>
 					<td> <a href ="../Modification/Change_Depense.php?id=<?php echo $repo['Id_Depense'];?>"> modifier<a></td>
 					<td> <a href ="../Delete/Delete_Depense.php ?id=<?php echo $repo['Id_Depense'];?>" onclick="return confirm('Voulez-vous supprimer?')"> Supprimer<a></td>
 						
 				</tr>
 				<?php 	
 			}
 			?>
 				</table>
 				</center>
 				<?php 
 		}else{
 			echo "votre rapport n existe pas";
 		}
 }else{
 		?>
 		<center><p style= "color: red;letter-spacing: 1px;" > Vous n'etes pas connectés!! <a href="../Index.php">Connectez-vous</a></p></center>
 		<?php
 	}
  ?>
 </div>	
<?php
 require("../Footer.php");
?>
 </body>
</html>