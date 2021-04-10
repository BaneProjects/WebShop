<?php
session_start();
require_once("../klase/classLog.php");
$db=mysqli_connect("localhost", "root", "", "sajt");
mysqli_query($db, "SET NAMES utf8");
$metoda=$_SERVER["REQUEST_METHOD"];
switch($metoda)
{
     case "GET":

       if(isset($_GET["id"]))
       {
		   $id=$_GET["id"];
		   $upit="DELETE  FROM proizvodi WHERE id=".$_GET["id"];
		   mysqli_query($db,$upit);
		   if(mysqli_error($db))
		   {
			   echo "Greska!!!".mysqli_error($db)."<br>";
		   }
		   else
		   { 
	            Log::upisi("logs/korisnici.txt", "Uspešno obrisan proizvod sa Id-ijem: $id  od strane ".$_SESSION["user"]);
			    echo "Uspešno obrisan proizvod";
		   }			  
		   break;
	   }		
  	   
	$upit="SELECT * FROM proizvodi";
    $rez=mysqli_query($db, $upit);
    $sve=mysqli_fetch_all($rez, MYSQLI_ASSOC);
    $json=json_encode($sve, 256);
    echo $json;
}
?>