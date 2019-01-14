<div class="page_content">


<?php
	
	if(Session::is_teacher()){

			echo '

									<h1>Mes Exercices
									<a class="bouton" href="./index.php?controller=exerciceClassique&action=creerExercice">Publier un Exercice</a>
									<a class="bouton" href="./index.php?controller=exerciceClassique&action=list_a_corriger">Exercices à corriger</a>

			</h1>';	

	}else{

			echo '

									<h1>Mes Exercices
									<a class="bouton" href="./index.php?controller=exerciceClassique&action=list_en_attente">Voir mes rendus</a>
			

			</h1>';	


	}


			$i = 0;
		if($tab){
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
				$date_e=htmlspecialchars($e->get("tempsLimite"));
				$date_ajd = date("Y-m-d H:i:s");

			
				if(Session::is_teacher()){
 
					$bouton_suppr = '<a class="bouton_suppr" href="./index.php?controller=exerciceClassique&action=suppr&code=' .$code_e . '">Supprimer</a> ';

				}else{

					$bouton_suppr = '';

				}


				echo '


					<div class="div_list">

					
						<h3>' . $nom_e . '
						   </h3>
						<br>

						<legend>Dans ' . $theme_e.' </legend>

						
						<legend class="time" >A rendre avant le ' . $date_e . '</legend>

						<br>
						<div class="description">
							<a>'. $theme_e .'</a>
						</div>

						
						<div class="bloc_boutons">
							<h3>';
							if(Session::is_student()){
						echo '	
							
							<a class="bouton" href="./index.php?controller=exerciceClassique&action=faireExercice&id=' .$code_e . '">Faire l\'exercice </a>';
							}
							echo ' 
							<a class="bouton" href="./data/'.$theme_e_code.'.pdf">Voir le cours</a>
							'.$bouton_suppr.'
							 
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
		}else{
			echo "<h1>Vous n'avez aucun Exercices </h1>";
		}

		?>


</div>