<div class="page_content">


		<?php 

			if(Session::is_teacher()){

				echo '<h1> Mes cours <a class="bouton" href="./index.php?controller=cours&action=show_form_new">Publier un cours</a></h1>';

			}else{

				echo '<h1>Mes cours</h1>';

			}

		?>
	



		<?php

			$i = 0;

			foreach ($tab as $cours) {

				if($i==0){

					echo'<div class="ligne">';

				}
				
				$nom_cours = htmlspecialchars($cours->get("nomCours"));
				$code_matiere_cours = htmlspecialchars($cours->get("codeMatiere"));
				$date_cours = htmlspecialchars($cours->get("datePublication"));
				$chemin_cours=htmlspecialchars($cours->get("fichierCours"));
				$resume_cours = htmlspecialchars($cours->get("resumeCours"));
				$codeCours = htmlspecialchars($cours->get("codeCours"));

				$matiere_cours = ModelMatieres::select($code_matiere_cours);
				$nom_matiere_cours = htmlspecialchars($matiere_cours->get("nomMatiere"));



				echo '


					<div class="div_list">

					
						<h3>' . $nom_cours . '<a class="bouton_suppr" href="./index.php?controller=cours&action=suppr&code=' .$codeCours . '">Supprimer</a> <a class="bouton" href="'.$chemin_cours.'">Afficher le cours</a> </h3>
						<br>
						<legend>Dans ' . $nom_matiere_cours .' </legend>
						<legend>Publié le ' . $date_cours . '</legend>
						<br>
						<a>Résumé:'. $resume_cours .'</a>




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