<div class="page_content">

	<h1>Liste des Exercices (en attente de correction) 

	<?php


	
	if(Session::is_student()) echo '<a class="bouton" href="./index.php?controller=exerciceClassique&action=list_a_faire">Voir les exercices à réaliser </a>';
	echo '</h1>';
var_dump($tab);
			$i = 0;
			$d = 0;
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
				$fichier = htmlspecialchars($e->get("fichier"));


			


				echo '


					<div class="div_list">

					
						<h3>' . $nom_e . '
						   </h3>
						<br>
						<legend>Dans ' . $theme_e. ' </legend> ';
				if($dates[$d] <= $date_e){
					echo' 
						 <legend>Rendu le ' . $dates[$d] . '</legend>';
				}else{
					$dteStart = new DateTime($date_e); 
   					$dteEnd   = new DateTime($dates[$d]); 

					$dteDiff  = $dteStart->diff($dteEnd); 
					echo '<legend class="retard"> Rendu en retard de ' . $dteDiff->format("%d jour(s), %H heure(s) et %I minute(s)") . '</legend>';
				}
						 
				echo'



						 <br>
						 <a>'. $theme_e .'</a>

						<div class="bloc_boutons">
							<h3>	
							';
							
							if($fichier != NULL){ 
								echo ' <a class="bouton" href="'. $fichier .'"> Consulter la Correction </a>'; 
							}
				echo '		<a class="bouton" href="./data/'.$theme_e_code.'.pdf">Voir le cours</a>	 
							</h3>
						</div>



					</div>

				' ;

				$i++;
				$d++;


				if($i==4){

						echo'</div>';
						$i=0;

				}

				

			}
		}else{
			echo "aucun ex";
		}


		?>


</div>