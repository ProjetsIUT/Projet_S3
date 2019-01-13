<div class="page_content">



	<h1>Liste des Exercices à Corriger
<?php
	
	if(Session::is_teacher()) echo '<a class="bouton" href="./index.php?controller=exerciceClassique&action=creerExercice">Publier un Exercice</a>';
	echo '</h1>';

			$i = 0;
		if($tab){
			foreach ($tab as $e) {

				if($i==0){

					echo'<div class="ligne">';

				}
				
				$code_e = htmlspecialchars($e->get('idExercice'));
				$login = htmlspecialchars($e->get('loginEtudiant'));
				$ex = ModelExerciceClassique::select($code_e);
				$nom_e = htmlspecialchars($ex->get("nomExercice"));
				$theme_e_code = htmlspecialchars($ex->get("themeExercice"));
				$theme_e_cours=ModelCours::select($theme_e_code);
				$theme_e=htmlspecialchars($theme_e_cours->get('nomCours'));  
				$enonce_e=htmlspecialchars($ex->get("enonce"));
				$date_r=htmlspecialchars($e->get("date"));
				$date_e=htmlspecialchars($ex->get("date"));

			


				echo '


					<div class="div_list">

					
						<h3>' . $nom_e . '
						   </h3>
						<br>
						<legend>Dans ' . $theme_e.' </legend> 
						<legend>Fait par l\'etudiant '. $login .'</legend>';
						
				if($date_r >= $date_e){		
					echo'
						<legend>Rendu le ' . $date_r . '</legend>
						';
				}else{
					$dteStart = new DateTime($date_e); 
   					$dteEnd   = new DateTime($date_r); 

					$dteDiff  = $dteStart->diff($dteEnd); 

					echo '<legend class="retard"> En retard de ' . $dteDiff->format("%d jour(s), %H heure(s) et %I minute(s)") . '</legend>';
				}
				echo '

						<br>
						<a>'. $theme_e .'</a>

						<div class="bloc_boutons">
							<h3>	
							<a class="bouton" href="./index.php?controller=FaireExercice&action=correction&id=' .$code_e . '&login='. $login .'">Corriger l\'exercice </a> 
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
			echo "aucun ex";
		}

		?>


</div>