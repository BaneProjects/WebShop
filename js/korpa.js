$(document).ready(function(){
	popuniKorpu();
	popuniKupljene();
})

function popuniKorpu()
 {
	 $.post("ajax/ajax_korpa.php?funkcija=popuniKorpu",function(response){
		 $("#sadrzaj").html(response);
	 })
 }
 
 function popuniKupljene()
 {
	 $.post("ajax/ajax_korpa.php?funkcija=popuniKupljene",function(response){
		 $("#kupljeno").html(response);
	 })
 }
 
  function obrisi(idKupovine)
   {
	 if(!confirm("Da li ste sigurni?")) return false;
	 $.post("ajax/ajax_korpa.php?funkcija=obrisi", {idKupovine: idKupovine}, function(response){
		 $("#broj").html($("#broj").html()-1);
		 popuniKorpu();
	 })
   }

function kupi(idKupovine)
{
	if(!confirm("Da li ste sigurni?")) return false;
	 $.post("ajax/ajax_korpa.php?funkcija=kupi", {idKupovine: idKupovine}, function(response){
			 $("#broj").html($("#broj").html()-1);
		 popuniKorpu();
		 popuniKupljene();
	 });
}