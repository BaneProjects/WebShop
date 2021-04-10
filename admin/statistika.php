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
<title>Statistika</title>
<meta charset="utf-8">
<style>
body{
	background:#F5FFFA;
}
.box select {
  background-color: #0563af;
  color: white;
  padding: 12px;
  width: 250px;
  border: none;
  font-size: 16px;
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}
h1{
color:#6666ff;
}
.button {
  background-color:  #008CBA;
  border: none;
  color: white;
  padding: 12px 25px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 12px;
}
.box{
	border:1px solid blue;
	padding:10px;
	margin:10px;
	width:400px;
	border-radius:10px;
	background:#E0FFFF
}
</style>
</head>
<body>
<div class="box">
<h1>Statistika</h1> 
<a href="../index.php">Početna</a>
<br><br>
<form action="#"method="post">
<select name="log" id="log">  <!-- ovaj select ce mi prosledjivati imformacije koji fajl trebam da procitam-->
<option value="0" selected>--Izaberite Log--</option>
<option value="korisnici.txt">Aktivnost nad korisnicima</option>
<option value="proizvodi.txt">Aktivnost nad proizvodima</option>
<option value="logovanje.txt">Aktivnost logovanja</option>
</select><br><br>
<input type="submit" value="Procitaj Log" class="button">
</form>
</div>
<br>
<div>
<?php
if(isset($_POST["log"]) AND $_POST["log"]!="0")
{
	$datoteka=$_POST["log"];
	if(file_exists("logs/".$datoteka))
	{
	$tekst=file_get_contents("logs/".$datoteka);
	$tekst=str_replace("\r\n", "<br>", $tekst);
	echo "<div style='border:1px solid blue;padding:5px;margin:5px;width:600px;border-radius:10px;'>".$tekst."</div>";
	}
}
?>
</div>
</body>
</html>