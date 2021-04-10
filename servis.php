<?php
require_once("../sajt/klase/classBaza.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
	echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
	exit();
}
if(isset($_GET["id"]))
{
	
	//$id=$_GET["id"];
	$upit="SELECT * FROM vieewproizvodi WHERE idTelefona=".$_GET["id"]."";
	
$rez=$db->query($upit);
$red=$db->fetch_object($rez);
     echo  " <h2 style='text-align:center'>".$red->Naslov."</h2>";
	   echo"<img src='../slikeSajt/$red->Putanja' height='150px'><br>";
	   echo"<p>Cena :<span style='color:red'>".$red->Cena."</span></p>";
	    echo "<p>Pogledan: ".$red->Pogledan."</p>";
	  echo" <a href='proizvodi.php?id=$red->id'>Detaljnije o proizvodu</a>";    
}
?>