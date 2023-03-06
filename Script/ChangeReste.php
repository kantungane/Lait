
<?php 

	require "../Side/database.php" ;
		$idPaie =$_GET["idPaie"];
		$idCash =$_GET["idCash"];
		
		$compte=$pdo-> prepare("SELECT * FROM Paiements WHERE Id_Paiement=?");
			$compte->execute(array($idPaie));
			$row =$compte->rowcount();
			if($row > 0){
			while($ligne=$compte->fetch(PDO::FETCH_ASSOC)){
			
				$Reste= $ligne['Reste'];
				$Cash=$ligne['Cash'];
				$NewReste=$Reste+$Cash;
				$CashReste=$NewReste-$idCash;
				echo $CashReste;
		}
	}
?>

