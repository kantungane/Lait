<?php
try{ 

$pdo=new PDO ("mysql:host=localhost;dbname=lait;","root","");
$pdo->exec("set names utf8");

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOExeption $e){
	die('erreur:'.$e-> getmessage());

}
 ?>