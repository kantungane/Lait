<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Paiements WHERE Id_Paiement=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/PaiementDesAbonnes.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>