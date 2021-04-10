<?php
//sve ono sto ulazi u neki porces sto omugucava da se neki proces izvrsi
$db=mysqli_connect("localhost", "root", "", "sajt");
mysqli_query($db, "SET NAMES utf8");
$results_per_page=6;


if(!isset($_POST["page"]))
{
	$page=1;
	
}else{
	$page=$_POST["page"];
}
$this_page_first_result=($page-1)*$results_per_page;
$sql="SELECT * FROM vieewproizvodi ORDER BY id desc LIMIT ".$this_page_first_result.", ".$results_per_page;
$result=mysqli_query($db, $sql);
while($red=mysqli_fetch_object($result))
{
echo "<div id='main'>
       <div>
	  
	    <h2>".$red->Naslov."</h2>
	    <img src='../slikeSajt/$red->Putanja' height='150px'><br>
	   <p>Cena :<span style='color:red'>".$red->Cena."</span></p>
	   <p>Pogledan: ".$red->Pogledan."</p>";
	   $upit="SELECT * FROM komentari WHERE idProizvoda=$red->id";
	   $pomrez=mysqli_query($db,$upit);
	   echo "<p>Komentara:".mysqli_num_rows($pomrez)."</p>";
	   echo "<a href='proizvodi.php?id=$red->id'id='detaljiLink'>Detaljnije</a>
	   </div>
       </div>";
}

?>


