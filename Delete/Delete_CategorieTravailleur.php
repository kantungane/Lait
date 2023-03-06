<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Categorie_Travailleurs WHERE Id_Categorie=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/CategorieTravailleur.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>