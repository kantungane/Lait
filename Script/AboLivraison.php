<?php
require("../Side/database.php");

		$categorie=	$_GET["cate"];
		$nom =$_GET["nom"];
		$prenom =$_GET["prenom"];

 $conn = $pdo ->prepare("SELECT DISTINCT(Periode_Livraison) FROM Ventes WHERE Categorie_Abonne=? AND Nom_Client=? AND Prenom=? AND Periode_Livraison !=? ");
			$conn->execute(array($categorie,$nom,$prenom,'null'));
			$row=$conn->rowcount();
			if($row>0){
			
			while($lign=$conn->fetch(PDO::FETCH_ASSOC)){
				?>
	<option><?php echo $lign['Periode_Livraison']; ?></option>
			 	<?php
				}
			}
?>