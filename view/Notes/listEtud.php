<div class="page_content">

	<h1>Mon bulletin de notes</h1>

	<div class="box_center">
			<form id=filtres method=get action=./index.php>
				<input type=hidden name=controller value=notes>
				<input type=hidden name=action value=listByEtud>
				<label> Filtrer par : </label>

				<select name="codeMatiere" required  onchange="document.getElementById('filtres').submit();">
						<option value="" disabled selected>Matiere</option>
						<option value="all">Voir tout</option>
						<?php
							foreach($tab_nomMatieres_etud as $value) {
							  echo '<option value="'.current($tab_codesMatieres_etud).'"' .'>'.$value.'</option>';
							  next($tab_codesMatieres_etud);
							}
						?> 
				</select>


			</form>

				<table>

			<?php
			if(!empty($tab_notes)) {

				echo '
				<tr>

				<th>Intitulé de l\'exercice</th>
				<th>Cours</th>
				<th>Note obtenue</th>
				<th>Type d\'exercice</th>

				</tr>
				';

				foreach ($tab_notes as $note) {
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
							$codeCours=$cours->get('codeCours');
							$nomCours=htmlspecialchars($cours->get('nomCours'));

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
							$codeCours=$cours->get('codeCours');
							$nomCours=htmlspecialchars($cours->get('nomCours'));

						}

					}

					echo('

						<tr>
						 <td>'.$nomExercice. '</td>
						 <td><a href="./data/'.$codeCours.'.pdf">'.$nomCours.'</a></td>
						 <td>'.$noteObtenue .'</td>
						 <td>'.$typeExercice .'</td>
						</tr>

					');

				}
			}
			else {
				echo ('
					<p> '.$verif.' </p>
				');
			}

			?>

		</table>


	</div>	

</div>