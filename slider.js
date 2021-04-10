var slike=[];
slike[0]="../slikeSajt/slike/slajder1.jpg";
slike[1]="../slikeSajt/slike/slajder2.jpg";
slike[2]="../slikeSajt/slike/slajder3.jpg";
slike[3]="../slikeSajt/slike/sllajder4.jpg";
var brojac=0;
var div=document.getElementById("slider");
  var  glavna=document.createElement("img");
	glavna.src=slike[0];
	glavna.id="mojid";
	glavna.style.cssText="width:960px";
	div.appendChild(glavna);
var interval=setInterval(promeni, 4000);

function promeni()
{
 var a=document.getElementById("mojid");
     a.src=slike[brojac];
	 brojac++;
if(brojac==slike.length) brojac=0;

}

/*
var slike=[];
slike[0]="../slikeSajt/slike/iphone10.jpg";
slike[1]="../slikeSajt/slike/hero.jpg";
slike[2]="../slikeSajt/slike/logo.jpg";
var div=document.getElementById("slider");
var interval=setInterval(PromeniSliku, 2000);
var brojac=0;
    div.style.cssText="text-align:center;background:lightgray; padding:10px;margin:10px;width:500px"; 
var glavna=document.createElement("img");
    glavna.src=slike[0];
	glavna.id="mojid";
	glavna.style.cssText="width:150px; height:200px";
	div.appendChild(glavna);
	div.appendChild(document.createElement("br"));
	div.appendChild(document.createElement("br"));
	for(var i=0; i<slike.length; i++)
	{
		var slika=document.createElement("img");
		    slika.src=slike[i];
			slika.style.cssText="width:50px; height:70px";
			slika.setAttribute("slika", slike[i]);
			slika.onclick=function(){
            var novaSlika=this.getAttribute("slika");
             glavna.src=novaSlika;					 
			}
			div.appendChild(slika);
	}
	function PromeniSliku()
	{
	 var a=document.getElementById("mojid");
	    a.src=slike[brojac]
		brojac++;
		if(brojac==slike.length) brojac=0;
	}
	
	*/