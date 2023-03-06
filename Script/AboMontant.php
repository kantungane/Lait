<?php
require "../Side/database.php" ;
		$categorie =$_GET["cate"];
		$nom =$_GET["nom"];
		$prenom =$_GET["prenom"];
		$periode =$_GET["periode"];

 $conn = $pdo ->prepare("SELECT SUM(Montant) As Somme FROM Ventes WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison=? ");
			$conn->execute(array($categorie,$nom,$prenom,$periode));
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC)){
				
			 	 echo $lign['Somme']; 
				}
			}
?>