<!-- Onglets du menu -->
<?php
	/* ouverture d'une session */
	// cette instruction doit toujours être la première ligne du code pour fonctionner!!!!!!!!!!!!!
	//session_start();	
	// inclusion des paramètres et de la bibliothéque de fonctions ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_parametres.php');
    // connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('include/_inc_connexion.php');
?>

			 <link href="./styles/style.css" rel="stylesheet" type="text/css" />
			<br/>
			<!--  <a href="gestion.php"><li style="-webkit-border-top-left-radius: 3px;
			-moz-border-radius-topleft: 3px;border-top-left-radius: 3px;">Accueil</li></a> -->
			 <a href="gestion.php" class="btn">Accueil</a>
			 <a href="modifier.php" class="btn">Modifier mot de passe</a>
			 <a href="digicode.php" class="btn">Digicode</a>
			 <?php 
			 if($_SESSION['level'] == "admin"){ ?>
			 <a href="envoiMail.php" class="btn">Envoi d'email</a>
			 <?php } ?>
			 <a href="deconnexion.php" class="btn">Se déconnecter</a>
			 <br/>
			 <!-- <a href="index.php?action=deconnexion"><li style="-webkit-border-top-right-radius: 3px;
			-moz-border-radius-topright: 3px;border-top-right-radius: 3px;">Déconnexion</li></a> -->
