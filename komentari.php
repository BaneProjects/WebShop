<?php
$db=mysqli_connect("localhost", "root", "", "sajt");
mysqli_query($db, "SET NAMES utf8");
$metoda=$_SERVER["REQUEST_METHOD"];
 switch($metoda)
 {
	case "GET":     
	        if(isset($_GET["idKomentara"]))
			{
			
				$idKomentara=$_GET["idKomentara"];
				$akcija=$_GET["akcija"];
				if($akcija=="volime")
				{
					$upit="UPDATE komentari SET volime=volime+1 WHERE id={$idKomentara}";
				    mysqli_query($db, $upit);
				}		
			}
			break;
			
	CASE "POST":
		
	 if(isset($_GET["idKomentara"]))
	 {
				$idKomentara=$_GET["idKomentara"];
				$akcija=$_GET["akcija"];
		 if($akcija=="nevolime")
		 {
			  $upit="UPDATE komentari SET nevolime=nevolime+1 WHERE id={$idKomentara}";
		    	 mysqli_query($db, $upit);
		 }
	 }
 }
?>