<div class="page_content">

	<h1>Mon bulletin de notes</h1>


	<div class="box_center">

				<table>

			<tr>

				<th>Intitulé de l'exercice</th>
				<th>Cours</th>
				<th>Note obtenue</th>
				<th>Type d'exercice</th>

			</tr>

			<?php

				foreach ($tab_notes as $note) {
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