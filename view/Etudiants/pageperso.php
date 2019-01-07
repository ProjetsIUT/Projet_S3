 
	<div class="page_content" id="div_page_perso_etudiant">

		<div class="ligne">

			<div class="tab" id="tab_profil">

				<h3>Bienvenue sur Agora</h3>

				<a>Bienvenue dans votre espace personnel <?php echo $_SESSION["prenomUtilisateur"]?></a>
				<br>
				<br>
				<a>Vous utilisez la version bêta d'Agora. Certaines fonctionnalités ne sont pas encore disponibles</a>

			</div>


			<div class="tab" id="tab_cours">
 
				<h3>Mes Cours <a class="bouton"> Tous les cours</a></h3>



			</div>
		
			<div class="tab" id="tab_rappels">

				<h3>Évènements à venir <a class="bouton"> Gérer les évènements</a></h3>

			</div>

		</div>

		<div class="ligne">

			<div class="tab" id="tab_stats">

				<h3>Statistiques <a class="bouton"> Voir tous les stats</a></h3>
				<a>Ma moyenne générale:
				<?php echo($moyenneGenerale);
				?>/20</a>
				<br>
				<a>Mon classement:
				<?php echo($monClassement);
				?></a>

			</div>

			<div class="tab" id="tab_notes">

				<h3>Dernières notes <a class="bouton" href="./index.php?controller=notes&action=listByEtud">Bulletin</a></h3>
				<br>

				<?php

					$note = current($tab_notes);

					for($i=0;$i<5;$i++){

						if($note!=false){

							$noteObtenue=htmlspecialchars($note->get('note'));
							$typeExercice=htmlspecialchars($note->get('typeExercice'));


							if($typeExercice==="QCM"){

								$exercice=ModelQCM::select($note->get('codeExercice'));
								$nomExercice=$exercice->get('nomQCM');
		

							}else{

								$exercice=ModelExerciceClassique::select($note->get('codeExercice'));
								$nomExercice = $exercice->get('nomExercice');
				

							}

							echo '

								<a>'.$nomExercice.'<a>		
								<a class="note">'.$note->get('note').'/20</a>
								<br> 

							';

							$note=next($tab_notes);
						}

					}


				?>
			</div>

		</div>


	</div>

	
	
			
