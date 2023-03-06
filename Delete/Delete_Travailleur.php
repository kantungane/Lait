<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Travailleurs WHERE Id_Travailleur=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Travailleur.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>