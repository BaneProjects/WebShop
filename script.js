if(isset($_SESSION["status"])!="Administrator" || isset($_SESSION["status"])!="Korisnik")
{
	document.getElementById("forma").style.display = "none";
}

    