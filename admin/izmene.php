<?php
session_start();
require_once("../klase/classBaza.php");
require_once("../klase/classLog.php");
require_once("../funkcije.php");
if(!Prijavljen())
{
	echo "Morate biti prijavljeni da biste videli ovu stranicu<br><a href='../prijava.php'>Prijavite se<a/>";
	exit();
}
if($_SESSION["status"]!="Administrator")
{
	echo "Samo <b>Administrator</b> moze videti ovu stranicu!!!<br><a href='../prijava.php'>Prijavite se<a/>";
	exit();
}

$db=new Baza;
$db->connect();
if($db->connect_error())
{
	echo "Baza trenutno nije dostupna";
	exit();
}
$db->query("SET NAMES utf8");
?>
<html ng-app="mojModul" ng-controller="mojKontroler">
<head>
<style>
input[type=text]{
background:#AFEEEE;
}
input[type=text]:hover{
background:white;
}
body{
color:#000000;
font-size:20px;
background:#F5FFFA;
}
tr:nth-child(even){
background:#FFE4B5;
}
input[type=button]{
   padding:5px;
  transition-duration: 0.4s;
  cursor:pointer;

}

input[type=button]:hover {
  background-color: #4CAF50; 
  color: white;
}
h2{
color:#6666ff;
}
</style>
<title></title>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script>
<script src="index.js"></script>
</head>
<body>
<h2>Aktivnosti nad korisnicima</h2>
<a href="../index.php">Početna</a>
<br><br>
<div style="border:1px solid black;width:500px;padding:20px; background:#E0FFFF;border-radius:10px">
<input type="text" ng-model="id" readonly>Id<br><br>
<input type="text" ng-model="ime">Ime<br><br>
<input type="text" ng-model="prezime">Prezime<br><br>
<input type="text" ng-model="email">Email<br><br>
<input type="text" ng-model="lozinka">Lozinka<br><br>
<input type="text" ng-model="adresa">Adresa<br><br>
<input type="text" ng-model="status">Status<br><br>
<input type="button"  value="Snimi" ng-click="posaljiPodatke();">
<input type="button"  value="Izmeni" ng-click="izmeniPodatke();"><br><br>
<br>
<div style="border:1px solid black; margin:2px; padding:4px">
{{poruka}}
</div>
</div>
<br><br>
<input type="text" ng-model="search">Unesi termin za pretragu
<br><br>
<table border="1">
       <tr>
	      <th>Id</th>
		  <th>Ime</th>
	      <th>Prezime</th>
	      <th>Email</th>
		  <th>Lozinka</th>
	      <th>Adresa</th>
	      <th>Status</th>
		  <th>Brisanje</th>
		  <th>Izmena</th>
	   </tr>
       <tr  ng-repeat="korisnik in korisnici | filter:search">
	     <td>{{korisnik.id}}</td>
		 <td>{{korisnik.Ime}}</td>
		 <td>{{korisnik.Prezime}}</td>
		 <td>{{korisnik.Email}}</td>
		 <td>{{korisnik.Lozinka}}</td>
		 <td>{{korisnik.Adresa}}</td>
		 <td>{{korisnik.Status}}</td>
		 <td><input type="button" value="Obriši" ng-click="Obrisi(korisnik.id)"></td>
		 	 <td><input type="button" value="Izmeni" ng-click="pripremi(korisnik)"></td>
	   </tr>
</table>
</body>
</html>