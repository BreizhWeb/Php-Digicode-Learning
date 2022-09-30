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
		</br>
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


								table {
								    
								    margin-left:10px;	
									margin-top : 10px;	
								}
								table.center {
							    margin-left:10px;
								margin-top : 100px;	
							  }


								</style>
			<table>
	
			<tr>
				  <td>
					Voulez vous vraiment vous déconnecter ?<br><br>
					<div><button>
					 	<a href="index.php?action=deconnexion">OUI
					</button> </div>
					<br>
					<div><button> 
						<a href="gestion.php">NON
					</button> </div>
					
					 
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