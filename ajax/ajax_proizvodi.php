<?php
session_start();
require_once("../../sajt/klase/classBaza.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
	echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
	exit();
}
//var_dump($_SESSION["id"]);
if(isset($_POST["idProizvoda"]))
{
	$idProizvoda=$_POST["idProizvoda"];
	$upit="INSERT INTO korpa (idKupca, idProizvoda) VALUES (".$_SESSION["id"].", $idProizvoda)";
	$db->query($upit);
	if($db->error())echo $db->error();
	else
		echo "Proizvod je dodat u korpu";
}
?>


