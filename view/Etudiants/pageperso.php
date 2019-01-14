
	<div class="page_content" id="div_page_perso_etudiant">

		<div class="ligne">

			<div class="tab" id="tab_profil">

				<h3>Bienvenue sur Agora</h3>
				<br>
				<?php 
            	if(isset($error_page)) {
                	echo '<h3 style="color:#E70739;"> '.$error_page.' </h3> <br>';
            	}
            	?>
				<a>Bonjour, <?php echo $_SESSION["prenomUtilisateur"]?></a>
				<br>
				<a>Vous utilisez la version Alpha d'Agora. Certaines fonctionnalités ne sont pas encore disponibles.</a>
			
				<div class="theme">
				
					<form id="form_theme" action='./index.php' method="get">

						<input type="hidden" name="controller" value="Utilisateurs">
						<input type="hidden" name="action" value="setBackground">

				
						<select id="select_theme" name="theme"  onchange="document.getElementById('form_theme').submit();">
								
							<option disabled selected>Changer de thème</option>
							<option value="1">Par défaut</option>
							<option value="2">Clair</option> 
							<option value="3">City</option>
							<option value="4">Bureau</option>
							<option value="5">Forêt</option>
							<option disabled>Importer (indisponible dans la version alpha)</option>

						</select>

					</form>

				</div>

			</div>


			<div class="tab" id="tab_cours">
 
				<h3>Derniers cours publiés <a href="./index.php?controller=cours&action=list" class="bouton"> Tous les cours</a></h3>
			
				<?php

				
				if($tab_cours){

					$cours = current($tab_cours);

					for($i=0;$i<5;$i++){
							
							if($cours!=false){

								echo('

									<div class="panel_box">
										<a>'.$cours->get('nomCours').'
										<a title="Voir" href="'.$cours->get('fichierCours').'"><img src="./img/icones/eye.png" class="icones_right"></a>
							
										</a> 
										  
									</div> 

									');


							}

							$cours=next($tab_cours);


					}

				}else{ 

					echo '<br><a>Aucun cours publié </a>';
				}
				?>

			</div>
		
			<div class="tab" id="tab_rappels"> 
				<h3>Évènements à venir <a class="bouton"> Gérer les évènements</a></h3>
				<br>

				<a>Vous n'avez aucun évènement planifié</a>

			</div>

		</div>

		<div class="ligne">

			<div class="tab" id="tab_stats">

				<h3>Statistiques <a class="bouton" href="./index.php?controller=notes&action=statsEtud"> Plus de stats</a></h3>
			
				<?php

					if($monClassement==-1){

						echo('<br>Pas de statistiques enregistrées. Réalisez des QCM et des exercices pour commencer');

					}else{


						echo('
									<div class="panel_box center_content">
										<a>Ma moyenne générale: '.$moyenneGenerale).'/20</a>
									</div>

									<div class="center_content">
										<img class="graph" src="./view/Notes/graphes/moyenne_small.php">
									</div>
									


							';

					}

				?>
			

			</div>

			<div class="tab" id="tab_notes">

				<h3>Dernières notes <a class="bouton" href="./index.php?controller=notes&action=listByEtud">Bulletin</a></h3>
			
				<?php
				

				if($monClassement==-1){

					echo ('<br>Aucune note enregistrée. Réalisez des QCM et des exercices pour commencer');

				}else{



					$tab_notes=array_reverse($tab_notes);

					$note = current($tab_notes);

					for($i=0;$i<5;$i++){

						if($note!=false){

							$noteObtenue=htmlspecialchars($note->get('note'));
							$typeExercice=htmlspecialchars($note->get('typeExercice'));


							if($typeExercice==="QCM"){

								$exercice=ModelQCM::select($note->get('codeExercice'));

								if(!$exercice){

									$nomExercice='Exercice supprimé';

								}else{

									$nomExercice=$exercice->get('nomQCM');

								}

							
		

							}else{

								$exercice=ModelExerciceClassique::select($note->get('codeExercice'));

								if(!$exercice){

									$nomExercice = 'Exercice supprimé';

								}else{

									$nomExercice = $exercice->get('nomExercice');
				

								}
	

							}

							echo '
								<div class="panel_box">
									<a>'.$nomExercice.'<a>		 
									<a class="note">'.$note->get('note').'/20</a>
									<br> 
								</div>

							';

							$note=next($tab_notes);
						}

					}

				}


				?>

			</div>

			<div class="tab" id="tab_compte">
			<h3> Mon compte </h3>
			<?php
			echo '
			<br>
			<a class="bouton" href="./index.php?controller=utilisateurs&action=read&loginUtilisateur='.htmlspecialchars($_SESSION['loginUtilisateur']).'"> Consulter mes informations personnelles</a>
			<br>
			<br>
			<a class="bouton" href="./index.php?controller=utilisateurs&action=changemdp&loginUtilisateur='.htmlspecialchars($_SESSION['loginUtilisateur']).'"> Changer mon mot de passe </a>
			</div>';
				?>
		</div>


	</div>
