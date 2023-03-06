<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Depenses WHERE Id_Depense=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Depense.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>