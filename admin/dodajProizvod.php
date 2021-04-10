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
input[type=text]{
background:#AFEEEE;
}
input[type=text]:hover{
background:white;
}
body{
color:#000000;
font-size:20px;
background:#F5FFFA;
}
input[type=button]:hover {
  background-color: #4CAF50; 
  color: white;
}
h1{
color:#6666ff;;
}
.div select {
  background-color: #0563af;
  color: white;
  padding: 10px;
  width: 250px;
  border: none;
  font-size: 16px;
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}

input[type=submit]{
  transition-duration: 0.4s;

}

input[type=submit]:hover {
  background-color: #0563af; 
  color: white;
}
</style>
</head>
<body>
<div style="border:1px solid blue; margin:10px; padding:10px;width:400px; border-radius:10px" class="div">
<h1>Dodavanje proizvoda</h1> 
<a href="../index.php">Početna</a>
<br><br>
<form action="dodajProizvod.php" method="POST" enctype="multipart/form-data">
<select id="tel" name="tel">
<option value="0" selected>--Izaberite telefon--</option>
<?php
$upit="SELECT * FROM telefoni";
$rez=$db->query($upit);
while($red=$db->fetch_object($rez))
{
	echo "<option value='$red->id'>$red->Proizvodjac</option>";
}
?>
</select><br><br>
<input type="text" id="naslov" name="naslov" placeholder="Naslov"><br><br>
<input type="text" id="procesor" name="procesor" placeholder="Procesor"><br><br>
<input type="text" id="baterija" name="baterija" placeholder="Baterija"><br><br>
<input type="text" id="kamera" name="kamera" placeholder="Kamera"><br><br>
<input type="text" id="memorija" name="memorija" placeholder="Memorija"><br><br>
<input type="text" id="Op" name="op" placeholder="Operativni sistem"><br><br>
<input type="text" id="cena" name="cena" placeholder="Cena"><br><br>
<input type="file" id="putanja" name="putanja" placeholder="Unesi sliku"><br><br>
<input type="text" id="opis" name="opis" placeholder="Opis slike"><br><br>
<input type="submit" value="Dodaj"><br><br>
</form>
</div>
<?php //provera da li je setovan idTelefona
 if(isset($_POST["tel"]))
 {
	$id=$_POST["tel"];

	if($id!="0")
	{
	    if(isset($_POST["naslov"]) and $_POST["naslov"]!="" and  isset($_POST["procesor"]) and $_POST["procesor"]!="" and isset($_POST["procesor"]) and $_POST["procesor"]!=""
		 and  isset($_POST["opis"]) and $_POST["opis"]!="" and  isset($_FILES["putanja"]["name"]) and $_FILES["putanja"]["name"]!="" )
		{
			// unos u tabelu slike
			$putanja=$_FILES['putanja']['name'];
			//var_dump($putanja);
			$opis=$_POST["opis"];
		    $tmp=$_FILES["putanja"]["tmp_name"];
			$ekstenzija=pathinfo($_FILES["putanja"]["name"], PATHINFO_EXTENSION);
			$destinacija="../../slikeSajt/slike/".$_FILES['putanja']['name'];
			if($_FILES["putanja"]["size"]>1000000)
			{
				echo "Datoteka je prevelika";
				exit();
			}
			if($ekstenzija!="jpg" && $ekstenzija!="bmp" && $ekstenzija!="png")
			{
				echo "Ovo nije slika!";
				exit();
			}
	         if(move_uploaded_file($tmp, $destinacija))
			 {
				  $upit="INSERT INTO slike (Putanja, Opis) VALUES ('slike/{$putanja}','{$opis}')";
			      $db->query($upit);
			 	  $idSlike=$db->insert_id();	 
			         //var_dump($idSlike);
			 }else
			 {
				echo "NEUSPESNO PREBACIVANJE SLIKE!!!<br>";
				   
				 exit();
			 }
			
			
			//unos u tabelu proizvodi
			$naslov=$_POST["naslov"];
			$procesor=$_POST["procesor"];
			$baterija=$_POST["baterija"];
			$kamera=$_POST["kamera"];
			$memorija=$_POST["memorija"];
			$op=$_POST["op"];
			$cena=$_POST["cena"];
		   $upit="INSERT INTO proizvodi (Naslov, idTelefona, Procesor, Baterija, Kamera, Memorija, OperativniSistem, Cena,idSlike) VALUES ('{$naslov}', {$id}, '{$procesor}', '{$baterija}', '{$kamera}', 
		   '{$memorija}','{$op}','{$cena}', {$idSlike})";	
			$db->query($upit);
			 if($db->error())
			 {
				 echo "Greska!!!!!<br>".$db->error();
				 exit();
			 }
			 else
			 {
				 Log::upisi("logs/proizvodi.txt", "Uspesno dodat proizvod sa Id-ijem: $id  od strane ".$_SESSION["user"]);
				 echo "<div style='border:1px solid black;padding:3px;color:green'>Uspesno dodavanje proizvoda<div>";
			 }
				 
		}
		else{
			echo "<div style='color:red; border:1px solid blue; margin:5px;padding:5px;border-radius:10px'>Niste popunili sva potrebna polja za unos proizvoda!!!!!</div>";
		}
	}
	else
	{
		echo "<div style='color:red; border:1px solid blue; margin:5px;padding:5px;border-radius:10px'>Niste izabrali telefon!!!!!</div>";
	}
	 
 }	 

?>
</body>
</html>