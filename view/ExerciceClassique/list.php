<div class="page_content">

	<h1>Liste des Exercices <a class="bouton" href="./index.php?controller=exerciceClassique&action=creerExercice">Publier un Exercice </a></h1>



		<?php

			$i = 0;

			foreach ($tab as $e) {

				if($i==0){

					echo'<div class="ligne">';

				}
				
				$code_e = htmlspecialchars($e->get('idExercice'));
				$nom_e = htmlspecialchars($e->get("nomExercice"));
				$theme_e_code = htmlspecialchars($e->get("themeExercice"));
				$theme_e_cours=ModelCours::select($theme_e_code);
				$theme_e=htmlspecialchars($theme_e_cours->get('nomCours'));  
				$enonce_e=htmlspecialchars($e->get("enonce"));
				$date_e=htmlspecialchars($e->get("dateLimite"));

			


				echo '


					<div class="div_list">

					
						<h3>' . $nom_e . '
						   </h3>
						<br>
						<legend>Dans ' . $theme_e.' </legend>
						<legend>Publié le ' . $date_e . '</legend>
						<br>
						<a>'. $enonce_e .'</a>

						<div class="bloc_boutons">
							<h3>	
							<a class="bouton" href="./index.php?controller=exerciceClassique&action=faireExercice&id=' .$code_e . '">Faire l\'exercice </a> 
							<a class="bouton" href="./data/'.$theme_e_code.'.pdf">Voir le cours</a>
							<a class="bouton_suppr" href="./index.php?controller=exerciceClassique&action=suppr&id=' .$code_e . '">Supprimer</a> 
							</h3>
						</div>



					</div>

				' ;

				$i++;


				if($i==4){

						echo'</div>';
						$i=0;

				}

				

			}

		?>


</div>