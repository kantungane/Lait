<?php 

require '../Side/database.php';
$id=$_GET['id'];
$delete=$pdo-> prepare("DELETE FROM Categorie_Depenses WHERE Id_Categorie=?");
	$delete->execute(array($id));
	if($delete){
		
		header('location:../Home/CategorieDepense.php');
		exit;
	}else{
		echo "Erreur de suppression";
	}
 ?>