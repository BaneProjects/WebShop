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

//Provera da li kukiji postoje
if(isset($_COOKIE["user"]) and isset($_COOKIE["status"]) and isset($_COOKIE["id"]))
{
	        $_SESSION['user']=$_COOKIE["user"];
			$_SESSION['status']=$_COOKIE["status"];
			$_SESSION['id']=$_COOKIE["id"]; 
	       
}            
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>boostmobile</title>
<link rel="shortcut icon" href="../slikeSajt/slike/LogoIcon.jpg" type="image/x-icon"></link>
<link href="style.css" rel="stylesheet"></link>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"></link>
<script src="jquery-3.5.1"></script>
<!--<script src="filter.js"></script>-->
<script>

$(document).ready(function(){
    // load_data();	
	function load_data(page)
	{
		$.ajax({
			url: "pagination.php",
			type: "POST",
			data: {page, page},
			success: function(data){
				$("#glavni").html(data);
			}	
		});
	}
	$(document).on("click", ".active", function(e){
		e.preventDefault();
		var page_id=$(this).attr("id");
		console.log(page_id);
		load_data(page_id);
	});
	/*  
   var idTelefona=$(".div").click(function(){
	   var idTelefona=$(this).attr("id");
	   //alert(telefon);
	   $.ajax({
		   url: "Filtracija.php",
		   type: "POST",
		   data:{idTelefona:idTelefona},
		   success:function(data){
			   $("#glavni").html(data);
		   }
		   
	   });
   }); */ 
})
</script>
</head>
<body>
<div id="wrapper" class="notfront2">
<?php
include("_header.php");

?>
<div id="slider">
</div>
</div><!--end hero-->

<?php
if(isset($_GET["id"]))
{
Najgledanije($db, $_GET["id"]);	
}
else
{
	Najgledanije($db);
}

?>

<?php
   
PrikaziMeni($db);
?>

<?php

$upit="SELECT * FROM vieewproizvodi ORDER BY id desc";


$upit="SELECT * FROM vieewproizvodi ORDER BY id desc LIMIT 0,6";
//$upit="SELECT * FROM vieewproizvodi LIMIT ".$this_page_first_result.", ".$results_per_page;
if(isset($_POST['pretraga'])) $upit="SELECT * FROM vieewproizvodi WHERE Naslov LIKE '%".$_POST['pretraga']."%' ";
if(isset($_GET["id"])) $upit="SELECT * FROM vieewproizvodi WHERE idTelefona=".$_GET["id"]."";

$rez=$db->query($upit);

echo "<div id='glavni'>";
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

echo "</div>";

?>
<br>
<div id='pagination'>
<button class='active' id='1'>1</a>
<button class='active' id='2'>2</a>
<button class='active' id='3'>3</a>
</div>
<br>
<?php
include("_footer.php");
?>
</div><!--end wrapper-->
</body>
</html>
<script src="slider.js" type="text/javascript"></script>