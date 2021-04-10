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
if(!isset($_GET["id"]))
{
	echo "<div style='color:red;font-size:50px;font-weight:bold;margin:auto'>EROR 404</div>";
	return false;
}
?>
<!DOCTYPE>
<html ng-app="mojModul" ng-controller="mojKontroler">
<head>
<meta charset="utf-8">
<title>Sajt</title>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script>
<script src="proizvodi.js">
</script>
<link href="style.css" rel="stylesheet"></link>
<script src="js/jquery-3.5.1"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"></link>
<script src="js/proizvodi.js"></script>

</head>
<body>
<div id="wrapper" class="notFront">
<?php
include("_header.php");

?>
<!--<img src="../slikeSajt/slike/hero.jpg">-->
</div><!--end hero-->
<?php
//Najgledanije();
?>
<?php
 PrikaziMeni($db);
?>
<?php

$id=$_GET["id"];
$ispis="";

//POVECANJE POLJA POGLEDAN U BAZI
$upit="UPDATE vieewproizvodi SET Pogledan=Pogledan+1 WHERE id={$id}";
$db->query($upit);

//IZVLACENJE INFORMACIJA ZA JEDAN PROIZVOD
$upit="SELECT * FROM vieewproizvodi  WHERE  id={$id}";
$rez=$db->query($upit);
echo "<div id='main'>";
while($red=$db->fetch_object($rez))
{
echo "<div>
	   <img src='../slikeSajt/$red->Putanja'><br>
	    <h2>".$red->Naslov."</h2>
	   <p>Cena:<span style='color:red'>".$red->Cena."</span></p>";
	   if(prijavljen()) echo "<input type='button' onclick='UbaciUKorpu($red->id);' value='Ubaci u korpu'>";
	   else
		   echo "<b>Morate biti prijavljeni da biste kupili proizvod!</b><br><br><a href='prijava.php'>Prijavite se</a>";
     echo"</div>";	  
}
echo"</div>";
?>
<?php
//UBACIVANJE PODATAKA U TABELU
$upit="SELECT * FROM vieewproizvodi  WHERE  id={$id}";
$rez=$db->query($upit);
while($red=$db->fetch_object($rez))
{
	
	echo "<section>
            <div class='container'>
                <div class='headline'>
                    <h2>Karakteristike</h2>
                </div>

                <table class='tabela'>
                    <tr>
                        <th>Procesor</th>
                        <td>".$red->Procesor."</td>
                    </tr>

                    <tr>
                        <th>Baterija</th>
                        <td>".$red->Baterija."</td>
                    </tr>

                    <tr>
                        <th>Kamera</th>
                        <td>".$red->Kamera."</td>
                    </tr>

                    <tr>
                        <th>Memorija</th>
                        <td>".$red->Memorija."</td>
                    </tr>

                    <tr>
                        <th>Operativni Sistem</th>
                        <td>".$red->OperativniSistem."</td>
                    </tr>
                </table>
            </div>
        </section>";
	
}
?>
<div class="form-style">
<h2>Unesite Komentar</h2>
<form action="proizvodi.php?id=<?=$id?>" method="post">
<input type="text" id="ime" name="ime" placeholder="Unesite ime">
<br><br>
<textarea id="komentar" name="komentar" placeholder="Unesite komentar" rows="5" cols="20">
</textarea>
<br><br>
<input type="submit" value="Ostavite komentar"><br>
</form>
<br>
<br>
</div>
<hr>
<?php
if(!Prijavljen())
{
	echo "<div><h3 style='color:black'>Morate biti prijavljeni da biste ostavili komentar!</h3><a href='prijava.php'>Prijavite se</a></div>";
}
else
{
//SNIMANJE KOMENTARA U BAZU
if(isset($_POST["ime"]) and $_POST["ime"]!="" and isset($_POST["komentar"]) and $_POST["komentar"]!="")
{
	
	$ime=$_POST["ime"];
	$komentar=$_POST["komentar"];
    $id=$_GET["id"];
    $upit="INSERT INTO komentari (Ime, Komentar, idProizvoda)  VALUES ('{$ime}','{$komentar}', $id )";
	$db->query($upit);
	if($db->affected_rows()==1)
	{
		echo "<h4>Uspešno ste poslali komentar, biće vidljiv nakon sto ga administrator odobri</h4>";
	}	
}
}	
?>
<br>
<?php
//PRIKAZIVANJE KOMENTARA NA STRANICI
   $upit="SELECT * FROM komentari where IdProizvoda={$id} AND odobren=1";
		$rez=$db->query($upit);
		if($db->num_rows($rez)==0)
			echo "Nije postavljen ni jedan komentar!!!<br>Budite prvi.....<br><br>";
		else{
			while($red=$db->fetch_object($rez)){
				echo "<div style='border:1px solid black;padding:3px;margin:4px;width:300px'><b>$red->Ime</b> <i>$red->Vreme</i><br>";
				echo "<p>$red->Komentar</p><br>";
				if(prijavljen())
				{
					echo "<img src='../slikeSajt/slike/thumbsUp.jpg' style='width:30px;cursor:pointer' ng-click='povecaj($red->id);'>$red->volime";
				    echo "<img src='../slikeSajt/slike/thumbsDown.jpg' style='width:30px;cursor:pointer' ng-click='smanji($red->id);'>$red->nevolime";
					
					//echo "<a href='proizvodi.php?id=$id&idKomentara=$red->id&akcija=obrisi'>Obrisi komentar</a>";
				}
			    echo "</div>";				
			}
		}  
?>
<?php
include("_footer.php");
?>
</div><!--end wrapper-->
</body>
</html>