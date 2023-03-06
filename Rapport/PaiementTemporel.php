<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		
		input{
			width: 400px;
			height:30px;
			font-size: 20px;
			margin-left: 100px;
		}
		
	</style>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>
	<script src="../Lib/mainRapPaiement.js"type="text/javascript"></script>
</head>
<body>
	<?php 
	require("../Header.php");
	if(isset($_SESSION['username'])){
?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">               
<center><h3>Rapport de paiement temporel</h3></center>
</div>
<?php 
	require("../Side/Sidebar.php");

?>
 			
  <div class="container" style="height: 640px; margin-top: -665px;margin-left:350px;overflow-y: scroll;position: relative;" id="section">
  			<button class="btn"><a href="PaiementAbonnes.php">Paiement des Abonnés</a></button>
  			<button class="btn"><a href="PaiementdesAcheteurs.php">Paiement Des Acheteurs</a></button>
 			<button class="btn"><a href="PayPersonnel.php">Paiement Peronnel</a></button>
 			<button class="btn"><a href="RapportRedevable.php">Liste des Redevable</a></button>

		<form method="POST" >
		<div>
		<label >Debut</label><br>
		<input type="date" name="debut" autocomplete="off" id="debut">
		</div>
		<div style="margin-top: -55px;margin-left: 600px;"> 
		<label >Fin</label><br>
		<input type="date" name="fin" autocomplete="off" id="fin"><br><br>	
		</div>
	</form>
	<center>
	<div id="repo">
		
	</div>
	</center>

			
 		
 	<?php
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