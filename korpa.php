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
<html ng-app="mojModul" ng-controller="mojKontroler">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script>
<script src="proizvodi.js">
</script>
<style>
input[type=text]
{
	background:#FFEBCD;
	border-radius:5px;
	padding:7px;
}
textarea
{
	background:#FFEBCD;
	border-radius:5px;
}
input[type=submit],input[type=button] {
 padding:5px;
	font-size:12px;
	text-transform: uppercase;
	transition: all 500ms cubic-bezier(0.77, 0, 0.175, 1);	
	cursor: pointer;
}
input[type=submit]:hover{
	background-color:orange;
}
input[type=button]:hover{
	background-color:orange;
}
#tabela th{
	color:#8B0000;
}
</style>
<head>
<meta charset="utf-8">
<title>Sajt</title>
<link href="style.css" rel="stylesheet"></link>
<script src="js/jquery-3.5.1"></script>
<script src="js/korpa.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"></link>
</head>
<body>
<div id="wrapper" class="notFront">

<?php
include("_header.php");

?>

</div><!--end hero-->

<?php
//Najgledanije($db);
//<img src="../slikeSajt/slike/hero.jpg">

?>

<?php
    PrikaziMeni($db);
?>

   <h2>Sadržaj korpe</h2>
   <div id="sadrzaj">
   </div>
 <h2>Kupljeni proizvodi</h2>
  <div id="kupljeno"></div>
  
<?php
include("_footer.php");
?>
</div><!--end wrapper-->
</body>
</html>