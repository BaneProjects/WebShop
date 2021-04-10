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
padding:5px;
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
<script src="izmeniProizvod.js"></script>
</head>
<body>
<h2>Izmena proizvoda</h2>
<a href="../index.php">Početna</a>
<br><br>
<div style="border:1px solid black;width:500px;padding:20px; background:#E0FFFF;border-radius:10px">
<input type="text" ng-model="id" readonly>Id<br><br>
<input type="text" ng-model="naslov">Naslov<br><br>
<input type="text" ng-model="idTelefona" readonly>idTelefona<br><br>
<textarea ng-model="procesor" placeholder="Procesor" rows="5" cols="20"></textarea><br><br>
<textarea ng-model="baterija" placeholder="Baterija" rows="5" cols="20"></textarea><br><br>
<input type="text" ng-model="kamera">Kamera<br><br>
<input type="text" ng-model="memorija">Memorija<br><br>
<input type="text" ng-model="operativniSistem">OperativniSistem<br><br>
<input type="text" ng-model="cena">Cena<br><br>
<input type="button"  value="Izmeni" ng-click="izmeniPodatke();"><br><br>
<br>
<div style="border:1px solid black; margin:2px; padding:4px">
{{poruka}}
</div>
</div>
<br><br>

<br><br>

<table border="1">
       <tr>
	      <th>Id</th>
		  <th>Naslov</th>
	      <th>idTelefona</th>
	      <th>Procesor</th>
		  <th>Baterija</th>
	      <th>Kamera</th>
	      <th>Memorija</th>
		  <th>OperativniSistem</th>
		  <th>Cena</th>
		  <th>Izmeni</th>
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
		<td><input type="button" value="Izmeni" ng-click="pripremi(proizvod)"></td>
	   </tr>
</table>
</body>
</html>