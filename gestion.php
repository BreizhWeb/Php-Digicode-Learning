<?php 
	// cette instruction doit toujours être la première ligne du code pour fonctionner!!!!!!!!!!!!!
	session_start();
	// inclusion des paramètres et de la bibliothéque de fonctions ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_parametres.php');
    
	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_connexion.php');
?>
<!DOCTYPE HTML> 
<html lang="fr">
	   
  <head>
    <title>Maison des Ligues</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="./styles/style.css" rel="stylesheet" type="text/css" />
  </head>
  
  <body>
	<div id="entete">
		<img src="images/logo.jpg">
	</div>
  		
	</br>	
	<div id="menu">
		<?php include("menu.php"); ?>
	</div>
	</br>	
	</br>	
	
	
	<div id="pagegestionD">
			
		<div style="clear:both"></div>
		<style type="text/css">
								td,
								th {
								    border: 1px solid rgb(190, 190, 190);
								    padding: 65px;
								}

								td {
								    text-align: center;
								}

								tr:nth-child(even) {
								    background-color: #eee;
								}

								th[scope="col"] {
								    background-color: #696969;
								    color: #fff;
								}

								th[scope="row"] {
								    background-color: #d7d9f2;
								}

								caption {
								    padding: 10px;
								    caption-side: center;
								}

								table {
								    border-collapse: collapse;
								    border: 2px solid rgb(200, 200, 200);
								    letter-spacing: 1px;
								    font-family: sans-serif;
								    font-size: .8rem;
								}
								table.center {
							    margin-left:auto; 
							    margin-right:auto;
							  }


								</style>
			<table>
			</br>
			<tr>
				  <td>
					Nom : <?php echo $_SESSION['nom']; ?>
				  </td>
				  <td>
					Niveau : <?php echo $_SESSION['level']; ?>
				  </td>
				</td>
				<script language = "JavaScript" type = "text/javascript">
					function refresh(time)
					{
					  setTimeout(function () { window.location.reload(); }, time*100);
					}
					refresh(100);
					var d = new Date()
					var j = d.getDate()
					var m = d.getMonth() + 1
					var y = d.getYear()
					if (y < 999)
					y += 1900;
					var h = d.getHours()
					var mn = d.getMinutes()
					var mois, jour;
					var dayNames = new
					Array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
					if (m == 1)
					mois = " janvier";
					else if (m == 2)
					mois = " février";
					else if (m == 3)
					mois = " mars";
					else if (m == 4)
					mois = " avril";
					else if (m == 5)
					mois = " mai";
					else if (m == 6)
					mois = " juin";
					else if (m == 7)
					mois = " juillet";
					else if (m == 8)
					mois = " août";
					else if (m == 9)
					mois = " septembre";
					else if (m == 10)
					mois = " octobre";
					else if (m == 11)
					mois = " novembre";
					else if (m == 12)
					mois = " décembre";
					if (j == 1)
					jour = "1er"
					else
					jour = j;
					// Test pour déterminer la formule à employer
					if (h >= 18)
					document.write("Bonsoir, ");
					else
					document.write("Bonjour, "+"</br>");

					document.write("Aujourd'hui nous sommes le " + dayNames[d.getDay()] + " " + jour + " " + mois + " " + y + ", ")
					document.write("il est " + h)
					if (h < 2)
					document.write(" heure ")
					else
					document.write(" heures ")
					document.write(mn)
					if (mn < 2)
					document.write(" minute.")
					else
					document.write(" minutes.")
				</script>

			</td>
				 </tr>
				</table>
			   	  </td>
			 </tr>
			</table>
		<div style="clear:both"></div>
					
	</div>
   </body>
</html>