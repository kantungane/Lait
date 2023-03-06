<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Calendriers WHERE Id_Calendrier=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Calendrier.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>