<?php
require_once("funkcije.php");
?>
<div id="header">
   <div id="logo">
   <a href="index.php"><img src="../slikeSajt/slike/logo2.jpg" width="300px"></a>
   </div> <!--end logo-->
  
  <div id="nav">
  <ul>
      <?php
	   if(!Prijavljen())
	   {
		 echo "<li><a href='prijava.php'>Prijava</a></li>";
	   }
	   else
	   {
		   echo "<li><a href='index.php'>".$_SESSION["user"]."</a>
		         <ul>
		        <li><a href='prijava.php?odjava'>Odjavite se</a></li>
		        </ul> 
		        </li>";
	   }
	  ?>
	  <li><a href="kontakt.php">Kontakt</a></li>
	  <li><a href="onama">O nama</a></li>
	    <li><a href="index.php">Početna</a></li>
  </ul>
  </div> <!--end nav-->
</div> <!--end header-->
<div id="hero">