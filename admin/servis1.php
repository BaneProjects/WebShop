<?php
session_start();
require_once("../klase/classLog.php");
$db=mysqli_connect("localhost", "root", "", "sajt");
mysqli_query($db, "SET NAMES utf8");
$metoda=$_SERVER["REQUEST_METHOD"];

switch($metoda)
{
     case "GET":
	$upit="SELECT * FROM proizvodi";
    $rez=mysqli_query($db, $upit);
    $sve=mysqli_fetch_all($rez, MYSQLI_ASSOC);
    $json=json_encode($sve, 256);
    echo $json;
	break;
	
case "POST":
	$data=json_decode(file_get_contents("php://input"));
	 if(isset($_GET["id"]))
       {
		   $id=$_GET["id"];
		   $upit="UPDATE  proizvodi SET Naslov='{$data->naslov}',idTelefona='{$data->idTelefona}',Procesor='{$data->procesor}',Baterija='{$data->baterija}', 
		   Kamera='{$data->kamera}',Memorija='{$data->memorija}', OperativniSistem='{$data->operativniSistem}', Cena='{$data->cena}' WHERE id=".$_GET["id"];
		   mysqli_query($db,$upit);
		   if(mysqli_error($db))
		   {
			   echo "Greska!!!".mysqli_error($db)."<br>";
		   }
		   else
		   {
			   Log::upisi("logs/proizvodi.txt", "Uspesno izmenjen proizvod od strane: ".$_SESSION["user"]);
			    echo "Uspesno Izmenjen proizvod";
		   }			   
			  
		   break;
	   }		
}
?>