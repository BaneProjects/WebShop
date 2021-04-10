<?php
function Prijavljen()
{
 if(!isset($_SESSION["user"]) || !isset($_SESSION["status"]) || !isset($_SESSION["id"]))
	 return false;
	else
		return true;
}
function PrikaziMeni($db=null)
{
  echo "<div id='sidebar'>";
  
          echo  "<div id='divPretraga'>
		        <form action='index.php' method='post'>
			    <i class='fa fa-search' aria-hidden='true'></i>
		        <input type='text' id='pretraga' name='pretraga' placeholder='Pretraži telefon'/><br><br>
				</form>
		  </div>";		   
		  
	if(Prijavljen())
	{
		$upit="SELECT * FROM korpa WHERE idKupca=".$_SESSION["id"]." AND kupljen=0";
		$rez=$db->query($upit);
		$status=$_SESSION["status"];
		$broj=$db->num_rows($rez);
		switch($status)
		{
			case "Administrator":
			echo "<div><h3>Admin panel</h3>
			       <ul>
					    <a href='admin/izmene.php'><li>Aktivnosti nad korisnicima</li></a>
					    <a href='admin/statistika.php'><li>Statistika</li></a>
					    <a href='admin/dodajProizvod.php'><li>Dodavanje proizvoda</li></a>
						<a href='admin/BrisanjeProizvoda.php'><li>Brisanje proizvoda</li></a>
						<a href='admin/IzmeniProizvod.php'><li>Izmena proizvoda</li></a>
						<a href='admin/komentari.php'><li>Komentari</li></a>
						<a href='admin/galerije.php'><li>Galerije</li></a>
						<a href='admin/odgovori.php'><li>Odgovori</li></a><hr>
						
				   </ul>
			     </div>";
			 case "Korisnik":
			echo "<div><h3>Podaci</h3>
			       <ul>
				       <a href='korpa.php'><li>Pogledaj korpu(<span id='broj'>$broj</span>)</li></a>
			           </ul>";
					  $upit="SELECT * FROM telefoni";
					  $rez=$db->query($upit);
					  echo"<h3>IZABERITE MODEL</h3>";
					  while($red=$db->fetch_object($rez))
					  {
						  //<div class='div' id='$red->id'><li style='cursor:pointer'>$red->Proizvodjac</li></div>
						        echo"<ul>
								<a href='index.php?id=$red->id'><li>$red->Proizvodjac</li></a>
		
						        </ul>";     
					  }
                        
			   echo "</div>";
		}
	}
	     else{
			 
				         $upit="SELECT * FROM telefoni";
					  $rez=$db->query($upit);
					    echo"<h3>IZABERITE MODEL</h3>";
			          while($red=$db->fetch_object($rez))
					  {
						  // <div class='div' id='$red->id'><li style='cursor:pointer'>$red->Proizvodjac</li></div>
						 
						  echo "<div>
						        <ul>
                               	<a href='index.php?id=$red->id'><li>$red->Proizvodjac</li></a>
						        </ul>
						       </div>";
					  } 
			 
			  
		 }
		/* echo "<img src='../vezba/dostava.jpg' width='200px'>";*/
         echo"</div><!--end sidebar-->";
}
function Najgledanije($db, $kategorija="sve")
{ 
           if($kategorija=="sve")
		   $upit="SELECT * FROM vieewproizvodi ORDER BY Pogledan DESC LIMIT 0,3";
	   else
		   $upit="SELECT * FROM vieewproizvodi WHERE idTelefona={$kategorija} ORDER BY Pogledan DESC LIMIT 0,3";
		   $rez=$db->query($upit);
		   if($red=$db->fetch_object($rez))
		  {
	           if(file_exists("../slikeSajt/$red->Putanja"))
		      {
			     $slika="../slikeSajt/$red->Putanja";
		      }
		       else{
			      $slika="../slikeSajt/slike/noImage.jpg";
		           }
	         echo "<div style='text-align:center;background:#FF8C00;border;color:#F0F0F0'>
	         <h2 style='margin:0px;text-transform: uppercase;'>Najprodavaniji telefoni ove godine</h2>
	         </div>";
	          echo "<div id='products'>";
              echo  "<a href='proizvodi.php?id=$red->id'><div class='product'>
	          
              <img src='$slika' height='230px'>
		      <h3 style='margin:0px; text-align:center'>".$red->Naslov."</h3>
		      <p style='margin:0px'>Cena :<span style='color:red'>".$red->Cena."</span></p>
              <p>Pogledan: ".$red->Pogledan."</p>
		      </div></a>";
		  }
     if($red=$db->fetch_object($rez))
	 {
         if(file_exists("../slikeSajt/$red->Putanja")) $slika="../slikeSajt/$red->Putanja";
			
		 else $slika="../slikeSajt/slike/noImage.jpg' height='200px";
		
         echo "<a href='proizvodi.php?id=$red->id'><div class='product'>
	    
          <img src='$slika' height='230px'>
		  <h3 style='margin:0px; text-align:center'>".$red->Naslov."</h3>
		  <p style='margin:0px'>Cena :<span style='color:red'>".$red->Cena."</span></p>
		  <p>Pogledan: ".$red->Pogledan."</p>
          </div></a>";
	 }
		  if($red=$db->fetch_object($rez))
		  {
              if(file_exists("../slikeSajt/$red->Putanja")) $slika="../slikeSajt/$red->Putanja";
			
		      else $slika="../slikeSajt/slike/noImage.jpg' height='200px";
              echo "<a href='proizvodi.php?id=$red->id'><div class='product'>
	    
              <img src='$slika' height='230px'>
		      <h3 style='margin:0px; text-align:center'>".$red->Naslov."</h3>
		      <p style='margin:0px'>Cena :<span style='color:red'>".$red->Cena."</span></p>
              <p>Pogledan: ".$red->Pogledan."</p>
		      </div></a>";
		  }
 echo "</div><!--end products-->";
}
?>