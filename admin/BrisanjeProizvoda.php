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
  transition-duration: 0.4s;
  cursor:pointer;
}
input[type=button]:hover {
  background-color: #4CAF50; 
  color: white;
}
h1{
color:#6666ff;
}
</style>
<title></title>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script>
<script src="izmene.js"></script>
</head>
<body>
<h1>Brisanje proizvoda</h1>
<a href="../index.php">Početna</a>
<br><br>
<div style="border:1px solid black; margin:2px;padding:4px">
{{poruka}}
</div>
</div>
<br><br>
<table border="1">
       <tr>
	      <th>Id</th>
		  <th>Naslov</th>
	      <th>IdTelefona</th>
	      <th>Procesor</th>
		  <th>Baterija</th>
	      <th>Kamera</th>
	      <th>Memorija</th>
		  <th>OperativniSistem</th>
		  <th>Cena</th>
		  <th>Pogledan</th>
		  <th>IdSlike</th>
		  <th>Obrisi</th>
		
	   </tr>
       <tr  ng-repeat="proizvod in proizvodi">
	     <td>{{proizvod.id}}</td>
		 <td>{{proizvod.Naslov}}</td>
		 <td>{{proizvod.IdTelefona}}</td>
		 <td>{{proizvod.Procesor}}</td>
		 <td>{{proizvod.Baterija}}</td>
		 <td>{{proizvod.Kamera}}</td>
		 <td>{{proizvod.Memorija}}</td>
		 <td>{{proizvod.OperativniSistem}}</td>
		 <td>{{proizvod.Cena}}</td>
		 <td>{{proizvod.Pogledan}}</td>
		 <td>{{proizvod.idSlike}}</td>
		 <td><input style="padding:12px" type="button" value="Obrisi" ng-click="obrisi(proizvod.id);"</td>
	
		<!-- <td><input type="button" value="Obriši" ng-click="Obrisi(korisnik.id)"></td>-->
	   </tr>
  
</table>
</body>
</html>