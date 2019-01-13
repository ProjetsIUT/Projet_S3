
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

			</div>


			<div class="tab" id="tab_cours">
 
				<h3>Derniers cours publiés <a href="./index.php?controller=cours&action=list" class="bouton"> Tous les cours</a></h3>
				<br>

				<?php

				$cours = current($tab_cours);


				for($i=0;$i<5;$i++){
						
						if($cours!=false){

							echo('

								<a>'.$cours->get('nomCours').'</a>
								<a class=note href='.$cours->get('fichierCours').'>Consulter</a>
								<br>

								');


						}

						$cours=next($tab_cours);


				}

				?>

			</div>
		
			<div class="tab" id="tab_rappels">

				<h3>Évènements à venir <a class="bouton"> Gérer les évènements</a></h3>

			</div>

		</div>

		<div class="ligne">

			<div class="tab" id="tab_stats">

				<h3>Statistiques <a class="bouton" href="./index.php?controller=notes&action=statsEtud"> Plus de stats</a></h3>
				<br>
				<?php

					if($monClassement==-1){

						echo('Vous n\'avez pas encore de statistiques car vous n\'avez aucune note ');

					}else{


						echo('
									<a>Ma moyenne générale: '.$moyenneGenerale).'/20
									</a>
									<br>
									<a>Mon classement: '.$monClassement.'/'.$taillePromo.'</a>
									<br>
									<br>
									<div class="center_content">
										<img id="graph" src="./view/Notes/graphes/moyenne_small.php">
									</div>
									


							';

					}

				?>
			

			</div>

			<div class="tab" id="tab_notes">

				<h3>Dernières notes <a class="bouton" href="./index.php?controller=notes&action=listByEtud">Bulletin</a></h3>
				<br>



				<?php
				

				if($monClassement==-1){

					echo ('Aucune note enregistrée. Réalisez des QCM et des exercices pour commencer');

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

								<a>'.$nomExercice.'<a>		
								<a class="note">'.$note->get('note').'/20</a>
								<br> 

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
