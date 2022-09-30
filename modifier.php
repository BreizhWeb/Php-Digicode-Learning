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
								    padding: 100%;
								    caption-side: top;
								}
								table
								{	
									margin-left:80px;
									float : center;
									margin-top:10px;
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
	
				    <form action="modifier.php?action=modifMdp" method="post">
				    	<td width="100px">
						Entrer le nouveau MDP :
						</br>
						<input type="password" name="mdp1" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,}" placeholder="Une majuscule, une minuscule, un chiffre et 10 caractères requis" size="56" required>
						</br></br>
						Confirmer le nouveau le MDP :
						<input type="password" name="mdp2" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,}" placeholder="Une majuscule, une minuscule, un chiffre et 10 caractères requis" size="56" required>	<br/><br/>
						<input type="submit" name="btnSubmit" id="buttonsubmit">
					</form>	  
			
			</table>
		<div style="clear:both">
			<?php

		if(isset($_GET["action"]))
		{
			if($_GET["action"] == "modifMdp") {

				if( (!empty($_POST["mdp1"])) && (!empty($_POST["mdp2"])) ) {

					$username = $_SESSION['nom']; // recupération du nom d'utilisateur
					//recuperation des 2 mot de passe 
					$password = $_POST["mdp1"]; 
					$confpassword = $_POST["mdp2"];
					//verification des mdp recupere
					if($password == $confpassword) {
						if(preg_match('/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,}/m', $password) == true) {
						$newpassword = md5($password);
						//preparation de la requete permettant de verifier un mot de passe existant
						$reqv = $cnx->prepare("SELECT password FROM mrbs_users WHERE name = :name");
						//assignation des valeurs
						$reqv->bindValue(':name', $username, PDO::PARAM_STR);
						$reqv->execute();
						$res = $reqv->fetch();
							if($res == true) {
								$oldpassword = $res["password"];
								//echo $oldpassword;
								if($oldpassword != $newpassword){
									$req = $cnx->prepare("UPDATE mrbs_users SET password = :pass WHERE name = :name");
									// liaison de la variable à la requête préparée
									$req->bindValue(':pass', $newpassword, PDO::PARAM_STR);
									$req->bindValue(':name', $username, PDO::PARAM_STR);
									$result = $req->execute();

									if($result){
										echo message("Mot de passe modifié avec succès !");
									}else{
										echo message("Erreur ! Veuillez contacter l'administrateur.");
									}
								}else{
									echo message("Désolé ! Le nouveau mot de passe est le même que l'ancien.");
								}
							}else{
								echo message("Erreur ! Veuillez contacter l'administrateur.");
							}
						}else{
							echo message("Désolé ! Votre mot de passe doit au moins faire 10 caractères.");
						}
					}else{
						echo message("Attention ! Veuillez vérifier si vos mots de passe sont identiques, supérieurs à 10 caractères et si ils continnent");
					}

				}else{
					echo message("Veuillez remplir les champs associés à votre requête.");
				}

			}
		}

		function message($msg){
				return "<div class='msg' align='center'><p> ".$msg." ! </p></div>";
			}
	?>
		</div>
					
	</div>
   </body>
</html>