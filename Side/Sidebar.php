<!DOCTYPE html>
<html>
<head>

	<title>your Sidebar</title>
	
	<style>
		a{
			text-decoration:none; 
			color: steelblue;
		}
		li{
			width: 350px;
			height: 48px;
			font-size: 25px;
			
		}
	.btn{
        height: 30px;
        width: 315px;
         background-image:radial-gradient(pink 25%,gray);
         	-webkit-transform:skewX(30deg);
    		-ms-transform:skewX(30deg);
   		 	transform:skewX(25deg);

   		 }	
		
	</style>



	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container" style="display: inline-block; background-color:pink;width:350px;height:auto;overflow: scroll;">

	
<ul>
		<li>
		<a href="#"><i class="fa-solid fa-gauge"></i></a>
		<a href="../Rapport/Dashboard.php">Accueil</a>
		</li>

		<?php
		require("database.php");
		$times=date('y-m-d');
		$notif=$pdo->prepare("SELECT Nom_Client,Prenom,Nom_Produit,SUM(Montant) As Somme,Periode_Livraison FROM Ventes WHERE Etat_Paiement=?  AND Categorie_Abonne!=? AND Date_Paiement<=? GROUP BY Periode_Livraison");
 		$notif->execute(array('Non','null',$times));
 		$rowNotif=$notif->rowcount();
 		if(isset($rowNotif) AND ! empty($rowNotif)){$Notice= $rowNotif;}else{$Notice=0;}
 		?>
		<li class=" dropdown-toggle" data-toggle="dropdown" id="notificationtoggle"> 
		<a href="#"><i class="fa-solid fa-bell"></i><span style="color: red;"><?php echo $Notice;?></span></a>
		<a href="#">Notices</a>
		</li>
		<ul class="dropdown-menu" role="menu" id="notificationmenu" style="border-color: teal;margin-left: 300px;background: gray;color:red;">
		<?php
 		if ($rowNotif>0) {
 		while($repost=$notif->fetch(PDO::FETCH_ASSOC)){
 		?>
 		<li style="width:1100px;color: black;font-size: 15px;height: auto;">
 		<?php  echo  $repost['Nom_Client'] ;echo " ";echo $repost['Prenom']; echo " qui a été fourni depuis "; echo $repost['Periode_Livraison'];echo " avec une somme de ";echo $repost['Somme'];echo " fbu"; echo " a déjà atteint sa date de paiement !!!"; ?>
 		</li>
 		<?php 	
 					}
 				}
 			?>
		</ul>

		
		

		<li class=" dropdown-toggle" data-toggle="dropdown" id="ventetoggle"> 
		 	<a href="#"><i class="fa-solid fa-basket-shopping"></i></a>
		 	<a href="#"> Vente des Produits</a>
		</li>

		<ul class="dropdown-menu" role="menu" id="ventemenu">
		<li><a href="../Home/VenteAuxAbonnes.php">Ventes Aux Abonnés</a></li>
		<li><a href="../Home/VenteAuxAcheteurs.php">Ventes Aux Acheteurs</a></li> 
		</ul>

		<li>
		<a href="#"><i class="fa-solid fa-cash-register"></i></a>
		<a href="../Home/PaiementDesAbonnes.php">Paiement des Abonnés</a>
		</li>

		<li class=" dropdown-toggle" data-toggle="dropdown" id="rapporttoggle"> 
 		<a href="#"><i class="fa-solid fa-money-bill-wheat"></i></a>
 		<a href="#">Rapport</a>
		</li>

		<ul class="dropdown-menu" role="menu" id="rapportmenu">
		<li><a href="../rapport/PaiementAbonnes.php">Rapport du Paiement</a></li>
		<li><a href="../Rapport/VenteAbonnes.php">Rapport de Vente</a></li> 
		</ul>

		<li>
		<a href="#"><i class="fa-brands fa-intercom"></i></a>
		<a href="../Home/Client.php">Clients</a>
		</li>
		


<li class=" dropdown-toggle" data-toggle="dropdown" id="abonnetoggle"> 
 	<a href="#"><i class="fa-solid fa-money-bill-wheat"></i></a>
 	<a href="../Home/Abonnement.php">Abonnement</a>
</li>

<ul class="dropdown-menu" role="menu" id="abonnemenu">
<li><a href="../Home/Abonnement.php">Abonnement</a></li>
<li><a href="../Home/CategorieAbonne.php">Categorie d'abonnement</a></li>
 
</ul>

<li>
	<a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
	<a href="../Home/Produit.php">Les Produits</a>
</li>
		

	<li class=" dropdown-toggle" data-toggle="dropdown" id="depensetoggle"> 
		 	<a href="#"><i class="fa-solid fa-shield"></i></a>
		 	<a href="../Home/Depense.php"> Depenses</a>
		</li>

		<ul class="dropdown-menu" role="menu" id="depensemenu">
		<li><a href="../Home/Depense.php">Depanser</a></li> 
		<li><a href="../Home/CategorieDepense.php">Categorie de Depense</a></li>
		
		</ul>


		<li>
		<a href="#"><i class="fa-solid fa-users-viewfinder"></i></a>
		<a href="../Home/Utilisateur.php">Utilisateurs</a>
		</li>
	
		<li class=" dropdown-toggle" data-toggle="dropdown" id="travatoggle"> 
		 	<a href="#"><i class="fa-solid fa-user-doctor"></i></a>
		 	<a href="../Home/Travailleur.php">Travailleurs</a>
		</li>

		<ul class="dropdown-menu" role="menu" id="travamenu">
		<li><a href="../Home/CategorieTravailleur.php">Categorie du Travailleur</a></li>
		<li><a href="../Home/Travailleur.php">Travailleurs</a></li> 
		</ul>	

		<li>
			<a href="#"><i class="fa-solid fa-calendar"></i></a>
			<a href="../Home/Calendrier.php">Calendrier</a>
		</li>
		

			
		
<li>
	<a href="#"><i class="fa-solid fa-ban"></i></a>
	<a href="../Deconnexion.php">Se Deconnecter</a>
</li>
	
	</ul>
	
</div>
</body>
</html>