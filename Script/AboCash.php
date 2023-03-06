<?php
require("../Side/database.php");


		$CashKey= $_GET["CashKey"];
		$categorie=	$_GET["cate"];
		$nom =$_GET["nom"];
		$prenom =$_GET["prenom"];
		$periode =$_GET["periode"];
		

 $conn = $pdo ->prepare("SELECT SUM(Montant) As Somme FROM Ventes WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=?  AND Etat_Paiement=?");
			$conn->execute(array($categorie,$nom,$prenom,$periode,'Non'));
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC)){
				
			 	 $Montant= $lign['Somme']; 
				}
			

			 $Abo= $pdo ->prepare("SELECT SUM(Cash) As Some FROM Paiements WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=? ");
			$Abo->execute(array($categorie,$nom,$prenom,$periode));
			
			while($ligne=$Abo->fetch(PDO::FETCH_ASSOC)){
				
			 	 $Sommation= $ligne['Some']; 

				}
				if(isset($Sommation) And ! empty($Sommation)){
			 	 	$Reste=$Montant-$Sommation;
			 	 	$ResteNew= $Reste-$CashKey ;
			 		 }else{$Reste=$Montant;
			 		 		$ResteNew= $Reste-$CashKey ;
			 		  }
			 		  echo $ResteNew;
				}
	
?>