$(document).ready(function(){
	$("#dugme").click(function(){
	 var email=$("#email").val();
	 var lozinka=$("#lozinka").val();
	  var zapamti=$("#zapamti").prop('checked');
        
		if(email=="" || lozinka=="")
		{
			$("#obavestenje").html("<span style='color:red'>Niste uneli sve podatke</span>");
			return false;
		}
		$.post("ajax/ajax_prijava.php?funkcija=prijava", {email:email, lozinka:lozinka, zapamti:zapamti}, function(response){
			//$("#obavestenje").html(response);
			 odg=JSON.parse(response);
			if(odg.greska!="")
				$("#obavestenje").html("<span style='color:red'>"+odg.greska+"</span>");
			else 
			window.location.assign(odg.gde);	
		});
	});
	$("#reg").click(function(){
	 $("#forma").show();
	});
	$("#registracija").click(function(){
		var ime=$("#ime").val();
		var prezime=$("#prezime").val();
		var email1=$("#email1").val();
		var lozinka1=$("#lozinka1").val();
		var potvrda=$("#potvrda").val();
		var adresa=$("#adresa").val();
		
		if(ime=="" || prezime=="" || email=="" || lozinka=="" || adresa=="")
		{
		$("#obavestenje1").html("<span style='color:red'>Niste uneli sve potrebne podatke za registraciju!</span>");
		return false;
		}
		if(lozinka1!=potvrda)
		{
		$("#obavestenje1").html("<span style='color:red'>Lozinka i ponovljena lozinka nisu iste</span>");
				return false;
		}
		$.post("ajax/ajax_prijava.php?funkcija=registracija", {ime:ime, prezime:prezime, email:email1, lozinka:lozinka1,
		potvrda:potvrda, adresa:adresa}, function(response){
		//$("#obavestenje").html(response);
			 odg=JSON.parse(response);
			if(odg.greska!="")
				$("#obavestenje1").html("<span style='color:red'>"+odg.greska+"</span>");
			else 
				$("#obavestenje1").html(odg.gde);
			
		});
			
	});
	
});