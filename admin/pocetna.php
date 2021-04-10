<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["status"]) && !isset($_SESSION["id"]))
{
	echo "Morate biti prijavljeni da biste videli ovu stranicu!!!<br><a href='../prijava.php>Prijavite se</a>'";
	exit();
}
else
{
	echo "Dobro došli <b>".$_SESSION["user"]."</b> Prijavljeni ste kao <b>".$_SESSION["status"]."</b><br><a href='../index.php'>Pocetna</a>";
}
?>