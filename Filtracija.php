<?php
require_once("funkcije.php");
require_once("../sajt/klase/classBaza.php");
$db=new Baza;
$db->connect();
$db->query("SET NAMES utf8");
if($db->connect_error($db))
{
echo "Doslo je do greske prilikom konekcije<br>".$db->connect_error();
exit();
}

if(isset($_POST["idTelefona"]))
{
	$idTelefona=$_POST["idTelefona"];
    $upit="SELECT * FROM vieewproizvodi WHERE idTelefona=".$_POST["idTelefona"]."";
    $rez=$db->query($upit);
	while($red=$db->fetch_object($rez))
{
echo "<div id='main'>
       <div>
	    <h2>".$red->Naslov."</h2>
	   <img src='../slikeSajt/$red->Putanja' height='150px'><br>
	   <p>Cena :<span style='color:red'>".$red->Cena."</span></p>
	   <p>Pogledan: ".$red->Pogledan."</p>";
	   $upit="SELECT * FROM komentari WHERE idProizvoda=$red->id AND odobren=1";
	   $pomrez=$db->query($upit);
	   echo "<p>Komentara:".$db->num_rows($pomrez)."</p>";
	   echo "<a href='proizvodi.php?id=$red->id'id='detaljiLink'>Detaljnije</a>
	   </div>
       </div>";
}

}



?>