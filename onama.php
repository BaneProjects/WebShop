<?php
session_start();
require_once("klase/classLog.php");
require_once("../sajt/klase/classBaza.php");;
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
<link href="lightbox2/css/lightbox.min" rel="stylesheet" />
<meta charset="utf-8">
<title>Galerija</title>
<link href="style.css" rel="stylesheet"></link>
<style>
h1{
	color:#989898;
}
p{
	font-size:18px;
	color:	#404040
}
</style>
</head>
<body>
<div id="wrapper">
<?php
include("_header.php");

?>
<div>
<h1>O nama</h1>

<p>BoostMobile kao OnLine prodavnica uspešno posluje na tržištu Srbije punih 7 godina sa timom ljudi koji su u poslu prodaje mobilnih telefona više
od 15 godina</p>

<p>Kako su proizvođači svakodnevno povećavali broj različitih modela kao i njihovih boja imali smo sve veće iskušenje kako da kupcima ponudimo kompletnu
lepezu proizvoda a da ih pri tome ne skladištimo na više mesta.</p>

<p>Kreativnim razmišljanjem došli smo do ideje da budemo u koraku sa vremenom i damo našim kupcima mogućnost kupovine telefona putem interneta i time 
omogućimo dostupnost svih aparata gde god da se nalaze. odajnom objektu ili nas kontaktirajte putem telefona ili preko društvenih mreža!</p>

<p>Svakodnevnim ažuriranjem našeg sajta pružamo informacije o svim modelima i njihovim uvek najpovoljnijim cenama, po kojima možemo da ih dostavimo na željenu adresu za 24h – 48h
 u zavisnosti od modela za koji se odlučite.</p>
<hr>
</div>
<?php
/*if(isset($_GET["idSlike"]))
{
	$upit="SELECT * FROM slikeradnje WHERE id=".$_GET["idSlike"];
	$rez=$db->query($upit);
	$red=$db->fetch_object($rez);
	echo "<img class='katalog' src='slikeRadnje/$red->Naziv' height='400px'>";
}*/
?>


<?php
//Čitanje svih galerija iz baze
$upit="SELECT * FROM slikeradnje";
$rez=$db->query($upit);
while($red=$db->fetch_object($rez))
{
	echo "<div style='float:left;margin:5px;border:2px solid black'><a href='slikeRadnje/$red->Naziv' data-lightbox='roadtrip' >
	<img data-lightbox='roadtrip' class='katalog' src='slikeRadnje/$red->Naziv' width='300px'></a></div>";
}



?>
<br><br>
<?php
include("_footer.php");
?>
</div><!--end wrapper-->
</body>
<script src="lightbox2/js/lightbox-plus-jquery.js"></script>
</html>