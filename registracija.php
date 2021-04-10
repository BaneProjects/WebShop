<?php
$db=mysqli_connect("localhost", "root", "", "sajt");
if(mysqli_error($db))
{
	echo "Doslo je do greske prilikom konekcije".mysqli_error($db)."<br>";
	exit();
}
mysqli_query($db, "SET NAMES utf8");
if(isset($_GET["email"]) and isset($_GET["vreme"]))
{
	$email=$_GET["email"];
	$vreme=$_GET["vreme"];
	$upit="UPDATE korisnici SET Validan=1 WHERE Email='{$email}' AND Validan=$vreme";
	mysqli_query($db, $upit);
	if(mysqli_affected_rows($db)==1)
	{
		echo "Uspesna potvrda mejla";
	}
	else
	{
	  echo "Neuspesna potvrda mejla";	
	}
}
?>