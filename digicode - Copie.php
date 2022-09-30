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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
  </head>
  <script>

	$(document).ready(function() {
 		$("#checkall").click(function() {
		
			$("input:checkbox").each(function(){
				
				var checked = $("#checkall").attr("checked");
				
				if(checked == "checked") {
					
					$(this).attr('checked', true);
				} else {
					
					$(this).attr('checked', false);
					
				}	
			});
 		});
	});
</script>
  <body>
	<div id="entete">
		<img src="images/logo.jpg">
	</div>
  		
		
	<div id="menu">
		<?php include("menu.php"); ?>
	</div>
	</br>	
	
	

	<?php
		
			global $cnx;
			// requête de vérification de l'existence du code 
			$req = $cnx->prepare("SELECT * FROM mrbs_parametres");
			$req->execute();
			//le résultat est récupéré sous forme d'objet
			$result=$req->fetch();
			
			// si le code existe déjà
			if($result == true){
				$digicode = $result["code"];
			}else{
				$digicode = "Code inexistant.";
			}
		

	?>
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
	<br/>
	<div id="pagegestionDD">
			
		<br/>

				<?php 
				if(isset($_SESSION['level'])){
					if($_SESSION['level'] == "admin"){
						$resultat = $cnx->query("SELECT * FROM mrbs_room_digicode;");
						$resultat->setFetchMode(PDO::FETCH_OBJ);								
						// lecture de la première ligne du jeu d'enregistrements
						$ligne = $resultat->fetch();
						?>
						<br/>	
						<form action="digicode.php?action=modifDigicode" method="post">
							<table class="center">
								<tr>
								    <th scope="col">N° de Salle</th>
								    <th scope="col">Digicode</th>
								    <th scope="col">Sélectionner</th>
								</tr>
							<tr>
								<td scope="row">
								</td>
								<td>
								</td>
								<td>


							<!-- Rounded switch -->
							<label class="switch">
							  <input type="checkbox" name="selectAll" id="checkall" align="center">
							  <span class="slider round"></span>
							  <label for="selectAll" align="center"></label>
							</label>
														

								</td>
							</tr>
								<?php while($ligne) { ?>
								<tr>
								<th scope="row"><?php echo $ligne->id; ?></th>
								<td>
								<input type="hidden" name="digicode" <?php echo 'value="'.$ligne->digicode.'"' ?>></ins><?php echo $ligne->digicode; ?></td>
								<td>
							
							<label class="switch">
							  <input type="checkbox" name="selected[]" <?php echo 'value="'.$ligne->id.'"' ?>>
							  <span class="slider round"></span>
							</label>
										
								</td>
								</tr>
							<?php $ligne = $resultat->fetch();} ?>
							<tr>
							<td scope="row">
							
						</td>
						<td scope="row">
							
						</td>
						<td scope="row">
							<input type="submit" name="modifier" align="center" id="buttonsubmit">
						</td>
					</tr>

						</table>
						</form>	  
				<?php
					}
					elseif ($_SESSION['level'] == 'user') {
							$date = new DateTime('today');
							$req=$cnx->prepare("SELECT * 
								FROM mrbs_entry,mrbs_room_digicode 
								WHERE mrbs_entry.room_id = mrbs_room_digicode.id 
								AND mrbs_entry.create_by=:nom");
							$req->bindValue(":nom",$_SESSION['nom'],PDO::PARAM_STR);
							$req->execute();
							$resultat=$req->fetch(PDO::FETCH_OBJ);
							if($resultat){
								?>
								<table class="center">
								<tr>
								    <th scope="col">N° de Salle</th>
								    <th scole="col">Code d'accès</th>
								    <th scope="">Début</th>
								    <th scole="col">Fin</th>
								</tr>
							<?php while($resultat) { 

							?>
							<?php if(!($date->getTimestamp() > $resultat->end_time) && ($date->getTimestamp() + 172798 >= $resultat->start_time)){ ?>
							<tr>		
								<td scope="row">
								<?=$resultat->room_id;?>
								</td>
								<td scope="row">
								<?=$resultat->digicode?>
								</td>
								<td scope="row">
								<?=date('d/m/Y H:i:s', $resultat->start_time);?>
								</td>
								<td scope="row">
									<?php if($date->getTimestamp() > $resultat->end_time){ echo 'FINI';} ?>
								<?=date('d/m/Y H:i:s', $resultat->end_time);?>
								</td>
							</tr>
						<?php }?>
							<?php  $resultat=$req->fetch(PDO::FETCH_OBJ); } }else{ echo "<br/>Vous n'avez pas réservé de salle.";} ?>
						</table>
							<?php 	
						}
					}
				?>
		<div style="clear:both">
		<?php


				if((isset($_GET["action"])) && ($_GET["action"] == "modifDigicode")) {
					if(isset($_POST['selected']) && is_array($_POST['selected'])){
						foreach($_POST['selected'] as $salle){
							$code = getCodeAlea();
						    $req = $cnx->prepare("UPDATE mrbs_room_digicode SET digicode = :code WHERE id = :id");
							// liaison de la variable à la requête préparée
							$req->bindValue(':code', $code, PDO::PARAM_STR);
							$req->bindValue(':id', $salle, PDO::PARAM_STR);
							$result = $req->execute();
						}

						if($result){
							echo message("Digicode modifié avec succès !");
							
						}else{
							echo message("Erreur ! Veuillez contacter l'administrateur.");
						}
						echo '<meta http-equiv="refresh" content="2; URL=digicode.php">';
					}
				}

			function getCodeAlea()
			{
				// création du code aléatoire
				$code=""; // initialisation de la variable qui contiendra le code

				$lettre="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; //constante contenant toutes les lettres qui constituront le code aléatoire

				$position=0;

				for ($i=0;$i<=5;$i++)
				{
					$position=rand(0,35); // on tire une position aléatoire	
						$code=$code.substr( $lettre , $position,1);
				}
				return $code; // on retourne le code généré
			}
			function message($msg){
				return "<div class='msg' align='center'><p> ".$msg." ! </p></div>";
			}
		?>

		</div>
			<br/>		
	</div>
	<br/>
   </body>
</html>