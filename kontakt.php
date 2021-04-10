<?php
session_start();
require_once("../sajt/klase/classBaza.php");
require_once("funkcije.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
	echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
	exit();
}
?>
<!DOCTYPE>
<html>
<head>
<style>
#map {
        height: 400px;
        width: 600px;
		border:2px solid black;
		width:600px;
		float:left;
		margin-bottom:20px;
		margin-top:20px;
}
input[type=text],input[type=email]
{
	background:#FFEBCD;
	border-radius:5px;
	padding:10px;
	font-size:14px;
	
}
textarea
{
	background:#FFEBCD;
	border-radius:5px;
	padding:15px;
}
input[type=submit]{
  padding:9px;
	font-size:12px;
	text-transform: uppercase;
	transition: all 500ms cubic-bezier(0.77, 0, 0.175, 1);	
	cursor: pointer;
}
input[type=submit]:hover{
	background-color:orange;
}

#map {
height: 400px;       
width: 600px;
</style>

<meta charset="utf-8">
<title>Sajt</title>
<link href="style.css" rel="stylesheet"></link>
<script>
      //Centriranje mape
      function initMap() {
        
        const map = new google.maps.Map(document.getElementById("map"),
		{zoom: 15,
        center:{lat: 44.848735, lng:  20.404619},
		 //mapTypeId: "hybrid", 
        });
        // Pozicioniranje markera 
        const marker = new google.maps.Marker({
          position:{lat: 44.848735, lng:  20.404619},
          map: map,
		  label:"1",
		  title:" Ovo je Lokacija",
		  animation: google.maps.Animation.BOUNCE,
        });
      }
</script>
</head>
<body>
<div id="wrapper">

<?php
include("_header.php");

?>
<div id="slider">

</div>
</div><!--end hero-->

<?php
//Najgledanije($db);

?>

<?php
    //PrikaziMeni();

?>
<?php
//Snimanje poruke u Bazu
 $poruka="";
if(isset($_POST["email"]) and isset($_POST["poruka"]) and isset($_POST["naslov"]))
{ 
 
  $email=$_POST["email"];
  $poruka=$_POST["poruka"];
  $naslov=$_POST["naslov"];
  if($email!="" and $poruka!="" and $naslov!="")
  {
	  $upit="INSERT INTO poruke (Email, Naslov, Poruka) VALUES ('{$email}', '{$naslov}', '{$poruka}')";
	  $db->query($upit);
	  if($db->affected_rows($db)==1)
	  {
		$poruka="<div style='color:green'>Uspešno ste poslali poruku administratoru</div><br>";
	  }
	  else
	  {
		$poruka="<span style='color:red'>Došlo je do greške</span>".$db->error();
	  }	  
  }
  else
  {
	$poruka="<div style='color:red'>Niste uneli sve potrebne podatke!!!</div><br>";
  }	  
	
}
?>
<?php
?>
<br>
<br><br>
<div id="map"></div>
<br>
<div style="float:right;border:2px solid black;width:300px;padding:10px;background:white">
<h2>BoostMobile</h2>
<p><b>Adresa</b>: Durmitorska 3,11000, Beograd</p>
<p><b>Radno vreme </b>:Pon - Pet: 09-19h Subotom od 10-15h</p>
<p><b>Telefoni: </b>011/41-42-720</p>
<p><b>Servis / prijem reklamacija: </b>	Cara Dušana 34, Zemun</p>
<h3>Kontakt e-mail adrese:</h3>
<p><b>Fizicka lica:</b>prodaja@bcgroup.rs</p>
</div>
<div style="border:2px solid black; padding:5px; width:600px;border-radius:10px;background:white;clear:both;text-align:center">
<h2>Pošaljite poruku Administratoru</h2>
<form action="kontakt.php" method="post">
<input type="email" id="email" name="email" placeholder="Unesite email"><br><br>
<input type="text" id="naslov" name="naslov" placeholder="Unesite naslov"><br><br>
<textarea id="poruka" name="poruka" placeholder="Unesite poruku" rows="5" cols="20"></textarea><br><br>
<input type="submit" value="Pošalji poruku"><br>
</form><br>
<h3><?= $poruka?></h3>
</div>
<br>
<?php
include("_footer.php");
?>

</div>
 <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8NNBkFqn-KgldMqPrugvU9mpWxSR5NKk&callback=initMap">
</script>
</body>
</html>