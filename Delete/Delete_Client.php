<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Clients WHERE Id_Client=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Client.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>