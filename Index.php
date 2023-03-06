<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<style type="text/css">
		
		form{
			width: 700px;
			height: 500px;
			background-color: grey;
			border: 1px solid black;
		}
		input{
			width: 600px;
			height: 50px;
			text-align: center;
			border: 1px solid black;
		}
		
		.ground{height: 640px;
					width: 100%;
					background-color:#A9A9A9;
					margin-top: 0px;
	
		.submit{
			width: 200px;
			height:30px;
			font-size: 20px;
			margin-left: 300px;
		}
	</style>
	
	<script src="Lib/jquery.js"type="text/javascript"></script>
	<script src="Lib/mains.js"type="text/javascript"></script>
</head>
<body>
	<?php require "Header.php";?>
 <div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -10px;height: 40px; ">               
	<center><h3>Formulaire d'authentification</h3></center>
</div>
<?php


require "Side/database.php" ;?>
<div class="ground">
	<br><br>
	<center><form method="POST"><br><br><br>
	

		<input type="text" name="username" autocomplete="off" placeholder="Entrer votre adresse username"><br><br><br>
		
		<input type="password" name="mdp" autocomplete="off" placeholder="Entrer votre mot de passe"><br><br><br>
			
		<input type="submit" name="submit"value="CONNECTEZ-VOUS ICI"><br><br><br>
		</form>
		</center>
<?php    

if(isset($_POST['submit'])){
		
		if (!empty($_POST['username']) AND !empty($_POST['mdp'])) {
			$username = htmlentities($_POST['username']);
			$password = md5($_POST['mdp']);
			$conn = $pdo ->prepare("SELECT * FROM Utilisateurs WHERE username = ? AND password = ?");
			$conn->execute(array($username,$password));
			$rower=$conn->rowcount();
			if($rower>0){
			
			while($ligne=$conn->fetch(PDO::FETCH_ASSOC))
			 {
				
				session_start();
				$_SESSION['username']=$ligne['Username'];
				
				$succes= "BIENVENUE";
				header('location:Rapport/Dashboard.php');
				}
			}else{
				$error="Votre mot de Passe ou username n'est pas correcte"; 
			}
		}else{
			$error="completer tous les champs";
		}
	} 
	//mise a jour du calendrier des abonnees
				$conn = $pdo ->prepare("SELECT * FROM Calendriers ");
				$conn->execute(array());
				$row=$conn->rowcount();
 				if ($row>0) {
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC)){
			 	$categorie=$lign['Categorie_Abonne'];	
			 	$nombre=$lign['Nombre'];
			 	$periode=$lign['Periode'];
			 	$validity=$nombre.$periode;
			 	$time=date('y-m-d');
			$repons=$pdo->prepare("SELECT * FROM Abonnements  WHERE Date_Fin <= ? AND Categorie_Abonne=? ");
 				$repons->execute(array($time,$categorie));
 				$rows=$repons->rowcount();
 				if ($rows>0) {
 			
 				while($repo=$repons->fetch(PDO::FETCH_ASSOC)){
 					$nom=$repo['Nom_Client'];
 					$prenom=$repo['Prenom'];
 					$Exdebut = $repo['Date_Debut'];
 					$Exfin =  $repo['Date_Fin'] ;
 					$date= new DateTime($Exfin);
					$date->modify($validity);
					$fin=$date->format('y-m-d');
					if($time >= $Exfin){
					$reponses=$pdo->prepare("UPDATE  Abonnements SET Date_Debut=?,Date_Fin=? WHERE Date_Fin <= ?  AND Nom_Client =?  AND Prenom =? AND Categorie_Abonne=? ");
 					$reponses->execute(array($Exfin,$fin,$time,$nom,$prenom,$categorie));
 							}
 					}
 				}
 			}
 		}else{$error= "Aucun programme prevu dans le Calendrier";}
?>


<center>
<p style="margin-top: -210px; color: red;letter-spacing: 1px;"><?php if (isset($error)) {echo $error;}?></p></center>
</div>
<?php require "Footer.php";?>
</body>
</html>