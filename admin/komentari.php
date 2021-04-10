<?php
session_start();
require_once("../klase/classBaza.php");
require_once("../klase/classLog.php");
require_once("../funkcije.php");
if(!Prijavljen())
{
	echo "Morate biti prijavljeni da biste videli ovu stranicu<br><a href='../prijava.php'>Prijavite se<a/>";
	exit();
}
if($_SESSION["status"]!="Administrator")
{
	echo "Samo <b>Administrator</b> moze videti ovu stranicu!!!<br><a href='../prijava.php'>Prijavite se<a/>";
	exit();
}
$db=new Baza;
$db->connect();
if($db->connect_error())
{
	echo "Baza trenutno nije dostupna";
	exit();
}
$db->query("SET NAMES utf8");
?>
<html>
<head>
<title>Komentari</title>
<meta charset="utf-8">
<style>
body{
	background:#F5FFFA;
}
</style>
</head>
<body>
<h1>Komentari</h1> 
<a href="../index.php">Početna</a>
<div>
<?php
if(isset($_GET["akcija"]) and isset($_GET["idKomentara"]))
{
	$akcija=$_GET["akcija"];
	$idKomentara=$_GET["idKomentara"];
	if($akcija=="odobri")
	{
		$upit="UPDATE komentari SET Odobren=1 WHERE id={$idKomentara}";
		$db->query($upit);
	}
	if($akcija=="obrisi")
	{
		$upit="DELETE FROM komentari WHERE id={$idKomentara}";
		$db->query($upit);
	}	
}
?>
<?php
$upit="SELECT * FROM komentari WHERE Odobren=0 ORDER BY Vreme DESC";
$rez=$db->query($upit);
if($db->num_rows($rez)==0)
{
	echo "Nema ni jedan komentar!<br>";
}
else
{
	while($red=$db->fetch_object($rez))
	{
		
		echo "<div style='border:1px solid black; margin:10px;padding:5px'>";
		echo "<b>$red->Ime</b> <i>$red->Vreme</i>";
		echo "<p>$red->Komentar</p>";
	    echo "<a href='komentari.php?akcija=odobri&idKomentara=$red->id'>Odobri</a> | <a href='komentari.php?akcija=obrisi&idKomentara=$red->id'>Obrisi</a>";
		echo "</div>";
		
		
	}
}
?>
</div>
</body>
</html>