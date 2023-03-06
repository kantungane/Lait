<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Produits WHERE Id_Produit=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/Produit.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>