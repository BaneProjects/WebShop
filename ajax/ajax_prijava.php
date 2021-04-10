<?php
session_start();
require_once("../../sajt/klase/classBaza.php");
require_once("../klase/classLog.php");
require_once("FunkcijeProvera.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
	echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
	exit();
}

if(isset($_GET['funkcija']) and $_GET['funkcija']!="")
{
	$izlaz["greska"]="";
	$izlaz["gde"]="";
	$funkcija=$_GET['funkcija'];
	if($funkcija=="prijava")
	{
		$email=$_POST['email'];
		$lozinka=$_POST['lozinka'];
		$zapamti=$_POST["zapamti"];
		//PROVERA 
		if(validanString($email) and validanString($lozinka))
		{
		$upit="SELECT * FROM korisnici WHERE Email='{$email}' AND lozinka='{$lozinka}' AND Validan=1";
		$rez=$db->query($upit);
		if($db->num_rows($rez)==0)
		{
			$izlaz['greska']= "Ne postoji korisnik";
			Log::upisi("../admin/logs/logovanje.txt", "Neuspešna prijava: ".$email. " ".$lozinka." (".$_SERVER['REMOTE_ADDR'].")" );
		}
		else
		{
			$red=$db->fetch_object($rez);
			$_SESSION['user']=$red->Ime." ".$red->Prezime;
			$_SESSION['status']=$red->Status;
			$_SESSION['id']=$red->id;
			
			//$izlaz['gde']= $_SESSION['user'];
			Log::upisi("../admin/logs/logovanje.txt", "Uspesna prijava za korisnika: ".$_SESSION["user"]);
			 if($zapamti=="true")
			{
				setcookie("user", $red->Ime." ".$red->Prezime, time()+(86400 * 30), "/");
				setcookie("status", $red->Status, time()+(86400 * 30), "/");
				setcookie("id", $red->id, time()+(86400 * 30), "/");
			}
			if($red->Status=="Administrator") 
			{
				$izlaz["gde"]="admin/izmene.php";
			}
			else
			{
				$izlaz["gde"]="index.php";
			}
				
		}
			
		}else
		{
		  $izlaz["greska"]="Neki od podataka sadrži nedozvoljene karaktere!";
		}
		
	}
	

	
	

	if($funkcija=="registracija")
	{
		//$izlaz["gde"]="Primljen zahtev";
		$ime=$_POST["ime"];
		$prezime=$_POST["prezime"];
		$email=$_POST["email"];
		$lozinka=$_POST["lozinka"];
		$potvrda=$_POST["potvrda"];
		$adresa=$_POST["adresa"];
		$vreme=time();
		//PROVERA
		if(validanString($ime) and validanString($prezime) and validanString($email) and validanString($lozinka))
		{
		$upit="INSERT INTO korisnici (Ime, Prezime, Email, Lozinka, Adresa, Status, Validan) VALUES 
		('{$ime}','{$prezime}','{$email}','{$lozinka}','{$adresa}','Korisnik', $vreme)";
        $db->query($upit);	
        if($db->error()) 
			$izlaz["greska"]=$db->error();
        else 
		{
			$poruka="Da biste potvrdili vas mejl, kliknite na link!<br><a href='http://localhost/sajt/registracija.php?email=$email&vreme=$vreme' target='_blank'>Potvrdite Email</a>";
			@mail($email, "Potvrda mejla", $poruka);
			$izlaz["gde"]=$poruka;	
		}		
			
		}else
		{
			$izlaz["greska"]="Neki od podataka sadrži nedozvoljene karaktere!";
		}
	}	
}
else
	$izlaz['greska']="Nema funkcije!";
    echo JSON_encode($izlaz, 256);
?>