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
  cursor:pointer;
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}
.box textarea{
	font-size:20px;
	padding:5px;
	
}


 
h1{
color:#6666ff;
}
input[type=submit] {
  background-color:  #008CBA;
  border: none;
  color: white;
  padding: 12px 25px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
   cursor:pointer;
  border-radius: 12px;
}
.box{
	border:1px solid blue;
	padding:10px;
	margin:10px auto;
	width:600px;
	border-radius:10px;
	background:#E0FFFF
}
</style>
</head>
<body>
<div class="box">
<?php
$poruka="";
if(isset($_POST["idPoruke"]) and isset($_POST["odgovor"]))
{
	$idPoruke=$_POST["idPoruke"];
	$odgovor=$_POST["odgovor"];
	if($idPoruke>0 and $odgovor!="")
	{
		$upit="UPDATE poruke SET odgovor='{$odgovor}' WHERE id={$idPoruke}";
		$db->query($upit);
		if($db->error())
			$poruka= "Doslo je do greske prilikom odgovaranja!<br>";
		else
		{
			
			$upit="SELECT * FROM poruke WHERE id={$idPoruke}";
			$rez=$db->query($upit);
			$red=$db->fetch_object($rez);
            // the message
             $msg = $red->Poruka."  ".$red->Odgovor;

             // use wordwrap() if lines are longer than 70 characters
             $msg = wordwrap($msg,70);

            // send email
           if(@mail($red->Email, $red->Naslov , $msg))
		        $poruka= "Uspesno poslat mejl!!!";
		    else
				$poruka= "<span style='color:red'>Neuspesno slanje mejla</span>. Poruka je <br>".$msg."<br><br>";
            
		}
	}
	else
	{
		$poruka="<span style='color:red'>Niste uneli sve potrebne podatke za odgovor!!!!!</span><br>";
	}	
}
?>

<h1>Odgovori na pitanja korisnika</h1> 
<a href="../index.php">Početna</a>
<br><br>
<form action="odgovori.php" method="post">
<select id="idPoruke" name="idPoruke">
<?php
$upit="SELECT * FROM poruke WHERE Odgovor='' OR isnull(Odgovor)";
$rez=$db->query($upit);
if($db->num_rows($rez)==0)
	echo "<option value='0' selected>--Nema neodgovorenih poruka--</option>";
else
	echo "<option value='0' selected>--Izaberite poruku--</option>";
	while($red=$db->fetch_object($rez))
	{
		echo "<option value='$red->id'>$red->Naslov</option>";
	}
?>
</select><br><br>
<textarea id="odgovor" name="odgovor" rows="5" cols="20" placeholder="Unesite odgovor"></textarea><br><br>
<input type="submit" value="Posalji odgovor">
</form>
<h3><?= $poruka?></h3>
</div>
</body>
</html>