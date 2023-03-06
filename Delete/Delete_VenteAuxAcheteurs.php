<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Ventes WHERE Id_Vente=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/VenteAuxAcheteurs.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>