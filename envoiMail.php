<?php 
	// cette instruction doit toujours être la première ligne du code pour fonctionner!!!!!!!!!!!!!
	session_start();
	// inclusion des paramètres et de la bibliothéque de fonctions ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_parametres.php');
    
	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_connexion.php');
	include ("include/Outils.class.php");
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
	
			<style type="text/css">
								td,
								th {
								    border: 1px solid rgb(190, 190, 190);
								    padding: 10px;
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
								    caption-side: bottom;
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
	
				    <form action="envoiMail.php?action=envoieMail" method="post"> 
				    <tr>			    
				    	<td>
							Destinataire :
						</td>
						<td>
							<select id="destinataire" name="destinataire[]" size="7" multiple>
								  <?php
								    $res = $cnx->prepare("SELECT email FROM mrbs_users ORDER BY email");
									$res->setFetchMode(PDO::FETCH_OBJ);
									$res->execute();
									while ($ligne = $res->fetch() )	{
									echo "<option name='destinataire' value=".$ligne->email.">".$ligne->email."</option>";
									}
								  ?>

							</select>
						</td>
					</tr> 
					<tr>			    
				    	<td>
							Sujet :
						</td>
						<td>
							<input type="text" name="sujet" required>
						</td>
					</tr>
					<tr>
						<td>
							Contenu du mail :
						</td>
						<td>
							<textarea rows="10" cols="35" name="contenuMail" required></textarea>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input type="submit" value="Envoyer" id="buttonsubmit">
						</td>
					</tr>
					</form>	  
			
			</table>
		<div style="clear:both">
<?php
	if(isset($_GET["action"])) {
		if($_GET["action"] == "envoieMail"){
			if(!empty($_POST["destinataire"])) {
				$dest_array = $_POST["destinataire"];			
				foreach($dest_array as $mailto){ 
					if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailto)) // On filtre les serveurs qui rencontrent des bogues.
					{
						$passage_ligne = "\r\n";
					}
					else
					{
						$passage_ligne = "\n";
					}		 
					//=====Définition du sujet.
					$sujet = $_POST["sujet"];
					//=====Création du header de l'e-mail.
					$header = "administateur@m2l.fr";
					//=====Création du message.
					$message = $_POST["contenuMail"];
					//=====Envoi de l'e-mail.
					// envoi du mail : destinataire, objet, message, émetteur
					if(Outils::envoyerMail ($mailto, $sujet, $message, $header)){
					//	echo "<div class='msg' align='center'><p> Mail envoyé avec succès ! </p></div>";
					}else{
						echo "<div class='msg' align='center'><p> Mail non envoyé à ".$mailto." </p></div>";
					}		
				}
			echo "<div class='msg' align='center'><p> Mail envoyé avec succès ! </p></div>";
		 }else{
		 	echo "<div class='msg' align='center'><p> Destinataire invalide ! </p></div>";
		 }
		}
	}
?>
		</div>
					
	</div>
   </body>
</html>


