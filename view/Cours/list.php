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
				
				$acces=htmlspecialchars($cours->get('accesCours'));
				$nom_cours = htmlspecialchars($cours->get("nomCours"));
				$code_matiere_cours = htmlspecialchars($cours->get("codeMatiere"));
				$date_cours = htmlspecialchars($cours->get("datePublication"));
				$chemin_cours=htmlspecialchars($cours->get("fichierCours"));
				$resume_cours = htmlspecialchars($cours->get("resumeCours"));
				$codeCours = htmlspecialchars($cours->get("codeCours"));

				$matiere_cours = ModelMatieres::select($code_matiere_cours);
				$nom_matiere_cours = htmlspecialchars($matiere_cours->get("nomMatiere"));

				if(Session::is_teacher()){

					$bouton_suppr = '<a class="bouton_suppr" href="./index.php?controller=cours&action=suppr&code=' .$codeCours . '">Supprimer</a>';
				}else{

					$bouton_suppr = '';

				}

				if($acces==1){

					$acces='<a class="cours_public">Cours public</a>';

				}else{

					$acces='';
				}



				echo '


					<div class="div_list"> 

					
						<h3>' . $nom_cours .$acces.'
				</h3>

						<br>
						<legend>Dans ' . $nom_matiere_cours .' </legend>
						<legend>Publié le ' . $date_cours . '</legend>
						<br>
						<div class="description">
							<a>Résumé:'. $resume_cours .'</a>
						</div>

						<div class="bloc_boutons">

							<h3>
								<a class="bouton" href="'.$chemin_cours.'">Afficher le cours</a> 
								' . $bouton_suppr . '</h3>

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