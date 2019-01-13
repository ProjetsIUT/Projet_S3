

	<div class="page_content" id="div_page_perso_enseignant">

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

		
						<select id="select_theme"  name="theme"  onchange="document.getElementById('form_theme').submit();">
							
							<option disabled selected=>Changer de thème</option>
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
 
				<h3>Derniers cours publiés <a href="./index.php?controller=cours&action=list" class="bouton"> Gérer les cours</a></h3>
		
				<?php

				if($tab_cours){

					$cours = current($tab_cours);

					for($i=0;$i<5;$i++){
							
							if($cours!=false){

								echo('

									<div class="panel_box">
										<a>'.$cours->get('nomCours').'
										<a title="Voir" href="'.$cours->get('fichierCours').'"><img src="./img/icones/eye.png" class="icones_right"></a>
										<a title="Supprimer" href="./index.php?controller=cours&action=suppr&code='.$cours->get('codeCours').'&redirection=accueil"><img src="./img/icones/bin.png" class="icones_right"></a>

										</a> 
										  
									</div> 

									');


							}

							$cours=next($tab_cours);


					}

				}else{

					echo '<br><a>Vous n\'avez pas encore publié de cours. Publiez-en dès maintenant pour remplir la liste de cours </a>';
				}

				?>

			</div>
		
		
			<div class="tab" id="tab_rappels">

				<h3>Derniers exercices reçus<a class="bouton" href="./index.php?controller=exerciceClassique&action=list_a_corriger"> Voir tout</a></h3>

				<?php

					if($tab_exs){

						$tab_exs = array_slice($tab_exs,0,5);

						foreach ($tab_exs as $rendu) {

							$codeEx = $rendu->get('idExercice');
							$ex = ModelExerciceClassique::select($rendu->get('idExercice'));
							$etudiant = ModelUtilisateurs::select($rendu->get('loginEtudiant'));
								
							echo'
						
									<div class="panel_box">
										<a>  ' .$ex->get('nomExercice') . '
										par ' . $etudiant->get('prenomUtilisateur') . ' ' . $etudiant->get('nomUtilisateur') . ' 
										<a title="Voir" href="./index.php?controller=FaireExercice&action=correction&id='.$rendu->get('idExercice').'&login='.$rendu->get('loginEtudiant').'"><img src="./img/icones/eye.png" class="icones_right"></a>
										</a>
									
									</div>
							';


						}

					}else{

						echo '<br> <a> Aucun exercice à corriger </a>';
					}

				?>

			</div>

		</div> 

		<div class="ligne">

			<div class="tab" id="tab_stats">

				<h3>Statistiques<a class="bouton" href="./index.php?controller=notes&action=statsEnseignant&codeMatiere=all"> Plus de statistiques</a></h3>
				<div class="panel_box center_content">
					<a>Moyennes de mes matières </a>
				</div>
				
				<div class="center_content">
						<img class="graph" src="./view/Notes/graphes/moyennesMatieres_small.php">
				</div>

			</div>

		</div>




	</div>

	
	
			

