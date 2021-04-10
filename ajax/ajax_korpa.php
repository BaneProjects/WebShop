<?php
session_start();
require_once("../../sajt/klase/classBaza.php");
require_once("../funkcije.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
	echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
	exit();
}

if(isset($_GET["funkcija"]))
{
	$funkcija=$_GET["funkcija"];
	if($funkcija=="popuniKorpu")
	{
		$upit="SELECT korpa.*, proizvodi.Naslov, proizvodi.Cena, slike.Putanja FROM korpa INNER JOIN proizvodi ON 
		korpa.idProizvoda=proizvodi.id INNER JOIN slike ON proizvodi.idSlike=slike.id_Slike WHERE idKupca=".$_SESSION['id']." AND kupljen='0' ORDER BY Vreme desc";
		$rez=$db->query($upit);
		if($db->num_rows($rez)==0)
		{
			echo "<span style='color:red'>Nemate nijedan proizvod u korpi<br><br><hr></span>";
		}
		else
		{
			while($red=$db->fetch_object($rez))
			{
				echo "<div style='border:1px solid black;width:400px;padding:5px;margin:3px;background:white;'>";
				echo "<img src=../slikeSajt/".$red->Putanja." height='120px'><br>";
				/*echo "ID-proizvoda:".$red->idProizvoda."<br>";*/
				echo "<b>Naziv</b>: ".$red->Naslov." (Cena: <span style='color:red'>".$red->Cena."</span>)<br>";
				echo "<b>Dodato u korpu</b>: <em>".$red->vreme."</em><br><br>";
				echo "<input type='button' onclick='kupi($red->id)' value='Kupi'> | <input type='button' onclick='obrisi($red->id)' value='Ukloni iz korpe'>";
				echo "</div>";
                			
			}
		}	
	}
	
	if($funkcija=="popuniKupljene")
	{
		$upit="SELECT korpa.*, proizvodi.Naslov, proizvodi.Cena, slike.Putanja FROM korpa INNER JOIN proizvodi ON 
		korpa.idProizvoda=proizvodi.id INNER JOIN slike ON proizvodi.idSlike=slike.id_Slike WHERE idKupca=".$_SESSION['id']." AND kupljen=1 ORDER BY Vreme desc";
		$rez=$db->query($upit);
		if($db->num_rows($rez)==0)
		{
			echo "Nemate nijedan kupljen proizvod";
		}
		else
		{
			
			while($red=$db->fetch_object($rez))
			{
				echo "<div style='border:1px solid black;width:400px;padding:5px;margin:3px;background:white'>";
				
				echo "<img src=../slikeSajt/".$red->Putanja." height='120px'><br>";
				//var_dump($red->Putanja);
				/*echo "ID:".$red->idProizvoda."<br>";*/
				echo "<b>Naziv</b>:".$red->Naslov." (Cena: <span style='color:red'>".$red->Cena."</span>)<br>";
				echo "<b>Kupljeno</b>: <em>".$red->vremeKupovine."</em><br><br>";
                echo "</div>";				
			}
		}	
	}
	if($funkcija=="obrisi")
    {
	$idKupovine=$_POST["idKupovine"];
	$upit="DELETE FROM korpa WHERE id=$idKupovine";
	$db->query($upit);
	}
	
	if($funkcija=="kupi")
    {
	$idKupovine=$_POST["idKupovine"];
	$upit="UPDATE korpa SET kupljen=1  WHERE id=$idKupovine";
	$db->query($upit);
	}	
}
?>