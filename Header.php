<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<style type="text/css">
		
	</style>
</head>
<body>
<?php
session_start();
?>
 <div style="width: auto;height: 70px;background-color: teal">
 	<div style="display: inline-block;width: 100px;margin-left: 10px;color: ivory">
				 		<?php
						if(isset($_SESSION['username'])){?><i class="fa-solid fa-signal"></i><br><?php echo($_SESSION['username']);}
						?>
 	</div> 
 	<div style="display: inline-block;"> 
 	<h1 style="letter-spacing: 5px;color: ivory; margin-left: 200px;">Gestion du Lait dans une ferme de vaches modernes</h1>
 	</div>

</div>
 
</body>
</html>