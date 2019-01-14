
<div class="page_content">

	<h1>Relevé de notes des étudiants</h1>

	<div class="box_center">

	<form id=filtres method=get action=./index.php>
		<input type=hidden name=controller value=notes>
		<input type=hidden name=action value=list>
		<label> Filtrer par : </label>

		<?php 

		?>

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

				foreach ($tab_notes as $note) {

					$etudiant= ModelUtilisateurs::select($note->get('codeEtudiant'));
					$nomEtudiant= htmlspecialchars($etudiant->get('prenomUtilisateur')) . " " . htmlspecialchars($etudiant->get('nomUtilisateur'));
					$noteObtenue=htmlspecialchars($note->get('note'));
					$typeExercice=htmlspecialchars($note->get('typeExercice'));


					if($typeExercice==="QCM"){

						$exercice=ModelQCM::select($note->get('codeExercice'));
						$nomExercice=$exercice->get('nomQCM');
						$cours=ModelCours::select($exercice->get('themeQCM'));
						$nomCours=htmlspecialchars($cours->get('nomCours'));


					}else{

						$exercice=ModelExerciceClassique::select($note->get('codeExercice'));
						$nomExercice = $exercice->get('nomExercice');
						$cours=ModelCours::select($exercice->get('themeExercice'));
						$nomCours=htmlspecialchars($cours->get('nomCours'));

					}

					echo('

						<tr>
						 <td>'.$nomEtudiant . '</td>
						 <td>'.$nomExercice. '</td>
						 <td><a href="./data/'.$cours->get('codeCours').'.pdf">'.$nomCours.'</a></td>
						 <td>'.$noteObtenue .'</td>
						 <td>'.$typeExercice .'</td>
						</tr>

					');

				}

			?>

		</table>

	</div>	


</div>