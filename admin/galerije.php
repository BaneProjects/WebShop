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
<title>Galerije</title>
<meta charset="utf-8">
<style>
#container{
border:1px solid black;
width:400px;
border-radius:10px;
padding:5px;	
}
#container h1{
	color:#206a5d;
	
}
.upload-box{
font-siize:16px;
background:white;
border-radius:50px;
box-shadow:5px 5px 10px black;
width:250px;
outline:none;
cursor:pointer;	
}
::-webkit-file-upload-button{
	color:white;
	background:#206a5d;
	padding:10px;
	border:none;
	border-radius:20px;
	box-shadow:1px  0 1px 1px #6b4559;
	outline:none;
}
::-webkit-file-upload-button:hover{
	background:#438a5e;
}
#dugme{
	padding:5px;
	background:#206a5d;
	color:white;
	box-shadow:0 5px 15px black;
}
#dugme:hover{
	background:#438a5e;
	cursor:pointer;
}
</style>
</head>
<body>

<br><br>
<div id="container">
<a href="../index.php">Početna</a>
<h1>Upload slika</h1>
<form action="galerije.php" method="post" enctype="multipart/form-data">
<input type="file" name="slika0"  id="slika0" class="upload-box"><br><br>
<input type="file" name="slika1"  id="slika1" class="upload-box"><br><br>
<input type="file" name="slika2"  id="slika2" class="upload-box"><br><br>
<input type="submit" value="Snimi sliku" id="dugme"><br><br>
</form>
</div>
<?php

	for($i=0; $i<count($_FILES); $i++)
	{
		if(isset($_FILES["slika".$i]["name"]) and $_FILES["slika".$i]["name"]!="")
	{
		$slika="1"."_".microtime(true).".jpg";
		if(move_uploaded_file($_FILES["slika".$i]["tmp_name"], "../slikeRadnje/".$slika))
		{
			$upit="INSERT INTO slikeradnje (Naziv) VALUES ('{$slika}')";
			$db->query($upit);
			if($db->error())
			{
				echo "Došlo je do greške<br>".$db->error();
				exit();
			}
			
		}
		else{
			echo "Neuspešno snimanje slike<br>";
		}
	}
	}
	
?>
</body>
</html>