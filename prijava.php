<?php
session_start();
require_once("klase/classLog.php");

//provera da li je korisnik vec ulogovan
if(isset($_SESSION["user"]) and isset($_SESSION["status"]) and isset($_SESSION["id"]))
{
	header("location: index.php");
}

//Odjava korisnika (unistavanje sesije i kukija)
if(isset($_GET["odjava"]))
{
	 if(isset($_SESSION["user"]))
	 {
	    Log::upisi("admin/logs/logovanje.txt", "Uspesna odjava za korisnika: ".$_SESSION["user"]);
	    unset($_SESSION['user']);
		unset($_SESSION['status']);
		unset($_SESSION['id']);
		session_destroy();
		setcookie("user", "" , time()-1, "/");
	    setcookie("status", "" , time()-1, "/");
		setcookie("id", "", time()-1, "/");
	 }
	  
}    
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>Sajt</title>
<link href="style.css" rel="stylesheet"></link>
<script src="js/jquery-3.5.1"></script>
<script src="js/prijava.js"></script>
<style>
input[type=text],input[type=email],input[type=password]
{
	background:#FFEBCD;
	border-radius:5px;
	padding:5px;
}
textarea
{
	background:#FFEBCD;
	border-radius:5px;
}
input[type=button]{
  padding:5px;
	font-size:12px;
	text-transform: uppercase;
	transition: all 500ms cubic-bezier(0.77, 0, 0.175, 1);	
	cursor: pointer;
}
input[type=button]:hover{
		background-color:orange;
}
</style>
</head>
<body>
<div id="wrapper">

<?php
include("_header.php");

?>

<!--<div id="slider">
</div>-->
</div><!--end hero-->
<div id="glavni" style="margin-left:200px">
<br>
<div style="background:white; border:1px solid black; border-radius:10px;width:500px;padding:5px;text-align:center">
<h2 style="color:black">ULOGUJTE SE</h2>
<input type="text" id="email" name="email" placeholder="Unesite email"><br><br>
<input type="password" id="lozinka" name="lozinka" placeholder="Unesite lozinku"><br><br>
<input type="checkbox" id="zapamti" name="zapamti">Zapamti me!<br><br>
<input type="button" id="dugme" value="Prijavite se"><br><br>
<div id="obavestenje"></div>
</div>
<br>
<br>
<div style="cursor:pointer" id="reg"><h3 style="color:black">Niste registrovani? Kliknite OVDE!</h3></div>
<div id="forma" style="padding:5px; border:1px solid black;width:500px; display:none;text-align:center; border-radius:10px; background:white; text-align:center">
<h4 style="color:black">REGISTRUJ SE<h4>
<input type="text" id="ime" name="ime" placeholder="Unesite ime"><br><br>
<input type="text" id="prezime" name="prezime" placeholder="Unesite prezime"><br><br>
<input type="email" id="email1" name="email1" placeholder="Unesite email"><br><br>
<input type="password" id="lozinka1" name="lozinka1" placeholder="Unesite lozinku"><br><br>
<input type="password" id="potvrda" name="potvrda" placeholder="Potvrdite vasu lozinku"><br><br>
<input type="text" id="adresa" name="adresa" placeholder="Unesite adresu"><br><br>
<input type="button" id="registracija" value="Registrujte se"><br><br>
<div id="obavestenje1"></div>
</div>
</div>

<?php
include("_footer.php");
?>
</div><!--end wrapper-->
</body>
</html>