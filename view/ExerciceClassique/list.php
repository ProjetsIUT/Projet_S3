<div class="page_content">



	<h1>Liste des Exercices à faire 
<?php
	
	if(Session::is_teacher()) echo '<a class="bouton" href="./index.php?controller=exerciceClassique&action=creerExercice">Publier un Exercice</a>';
	if(Session::is_student()) echo '<a class="bouton" href="./index.php?controller=exerciceClassique&action=list_en_attente">Voir les exercices en attente de correction</a>';
	echo '</h1>';

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

			


				echo '


					<div class="div_list">

					
						<h3>' . $nom_e . '
						   </h3>
						<br>
						<legend>Dans ' . $theme_e.' </legend>';
						
				if($date_e >= date("Y-m-d H:i:s")){		
					echo'
						<legend>A rendre avant le ' . $date_e . '</legend>
						';
				}else{
					$dteStart = new DateTime($date_e); 
   					$dteEnd   = new DateTime($date_ajd); 

					$dteDiff  = $dteStart->diff($dteEnd); 

					echo '<legend class="retard"> En retard de ' . $dteDiff->format("%d jour(s), %H heure(s) et %I minute(s)") . '</legend>';
				}
				echo '

						<br>
						<a>'. $theme_e .'</a>

						<div class="bloc_boutons">
							<h3>	
							<a class="bouton" href="./index.php?controller=exerciceClassique&action=faireExercice&id=' .$code_e . '">Faire l\'exercice </a> 
							<a class="bouton" href="./data/'.$theme_e_code.'.pdf">Voir le cours</a>
							
							 
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
			echo "<h1> Vous n'avez aucun exercice à faire pour l'instant </h1>";
		}

		?>


</div>