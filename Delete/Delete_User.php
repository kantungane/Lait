<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Utilisateurs WHERE Id_utilisateur=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Utilisateur.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>