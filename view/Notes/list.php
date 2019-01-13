
<div class="page_content">

	<h1>Relevé de notes des étudiants</h1>

	<div class="box_center">

	<form id=filtres method=get action=./index.php>
		<input type=hidden name=controller value=notes>
		<input type=hidden name=action value=list>
		<label> Filtrer par : </label>

		<select name="codeMatiere" required  onchange="document.getElementById('filtres').submit();">
						
						<option value="" disabled selected><?php if(isset($_GET['codeMatiere'])) {
							echo $nomM;						
						}
						else {
							echo "Matieres"; 
						}
						?></option>
						<option value="all">Voir tout</option>
						<?php
					
							foreach($tab_nomMatieres_enseig as $value) {
							  echo '<option value="'.current($tab_codesMatieres_enseig).'"' .'>'.$value.'</option>';
							  next($tab_codesMatieres_enseig);
							}
						?> 
		</select>
		<br>
		<br>

	</form>

		<table>

			<tr>
				<th>Nom Etudiant</th>
				<th>Intitulé de l'exercice</th>
				<th>Cours</th>
				<th>Note obtenue</th>
				<th>Type d'exercice</th>

			</tr>

			<?php 
	
			if(isset($tab_notes)){
				foreach ($tab_notes as $note) { 

					$etudiant= ModelUtilisateurs::select($note->get('codeEtudiant'));
					$nomEtudiant= htmlspecialchars($etudiant->get('prenomUtilisateur')) . " " . htmlspecialchars($etudiant->get('nomUtilisateur'));
					$noteObtenue=htmlspecialchars($note->get('note'));
					$typeExercice=htmlspecialchars($note->get('typeExercice'));


					if($typeExercice==="QCM"){

						$exercice=ModelQCM::select($note->get('codeExercice'));
						
						if(!$exercice){

							$nomExercice = "Exercice supprimé";
							$nomCours="Cours inconnu";
							$codeCours = "./";
							
						}else{

							$nomExercice=$exercice->get('nomQCM');
							$cours=ModelCours::select($exercice->get('themeQCM'));

							if(!$cours){

									$nomCours="Cours supprimé";
									$codeCours= "";
							}else{

									$codeCours=$cours->get('codeCours');
									$nomCours=htmlspecialchars($cours->get('nomCours'));

							}

						
						}


 
					}else{

						$exercice=ModelExerciceClassique::select($note->get('codeExercice'));
					
						if(!$exercice){

							$nomExercice = "Exercice supprimé";
							$nomCours="Cours inconnu";
							$codeCours ="./";

						}else{

							$nomExercice = $exercice->get('nomExercice');
							$cours=ModelCours::select($exercice->get('themeExercice'));

							if(!$cours){

									$nomCours="Cours supprimé";
									$codeCours= "";
							}else{

									$codeCours=$cours->get('codeCours');
									$nomCours=htmlspecialchars($cours->get('nomCours'));

							}

						}

			

				}


				echo('

						<tr>
						 <td>'.$nomEtudiant . '</td>
						 <td>'.$nomExercice. '</td>
						 <td><a href="./data/'.$codeCours.'.pdf">'.$nomCours.'</a></td>
						 <td>'.$noteObtenue .'</td>
						 <td>'.$typeExercice .'</td> 
						</tr>

				');
			}

		}

			?>

		</table>

		<?php

			if(!isset($tab_notes)){

				echo('<div class=center_content>Aucune note à afficher</div>');

			}

		?>

	</div>	


</div>