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
		   $upit="DELETE  FROM korisnici WHERE id=".$_GET["id"];
		   mysqli_query($db,$upit);
		   if(mysqli_error($db))
		   {
			   echo "Greska!!!".mysqli_error($db)."<br>";
		   }
		   else
		   { 
	            Log::upisi("logs/korisnici.txt", "Uspesno obrisan korisnik sa Id-ijem: $id  od strane ".$_SESSION["user"]);
			    echo "Uspesno obrisan korisnik";
		   }			  
		   break;
	   }		
  	   
	$upit="SELECT * FROM korisnici";
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
		   $upit="UPDATE  korisnici SET Ime='{$data->ime}',Prezime='{$data->prezime}',Email='{$data->email}',Lozinka='{$data->lozinka}', 
		   Adresa='{$data->adresa}',Status='{$data->status}' WHERE id=".$_GET["id"];
		   mysqli_query($db,$upit);
		   if(mysqli_error($db))
		   {
			   echo "Greska!!!".mysqli_error($db)."<br>";
		   }
		   else
		   {
			   Log::upisi("logs/korisnici.txt", "Uspesno izmenjen korisnik od strane: ".$_SESSION["user"]);
			    echo "Uspesno Izmenjen korisnik";
		   }			   
			  
		   break;
	   }	
	
	if(isset($data->ime))
	{
		$upit="INSERT INTO korisnici (Ime, Prezime, Email, Lozinka, Adresa, Status)
		VALUES ('{$data->ime}', '{$data->prezime}','{$data->email}','{$data->lozinka}','{$data->adresa}','{$data->status}')";
		mysqli_query($db, $upit);
		if(mysqli_error($db))
		{
			echo "Greska!!".mysqli_error($db)."<br>";
		}else
		{
			Log::upisi("logs/korisnici.txt", "Uspesno dodat korisnik: ".$data->email." "."od strane ".$_SESSION["user"]);
			echo "Uspesno dodat korisnik";
		}
			 
	}else
		echo "Niste poslali sve podatke";
	
	break;	
}
?>