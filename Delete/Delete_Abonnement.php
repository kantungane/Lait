<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Abonnements WHERE Id_Abonnement=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Abonnement.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>