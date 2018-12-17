<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

				<input type="hidden" name="controller" value="QCM" />
				<input type="hidden" name="action" value="save_qcm" />


				<p>Formulaire de création de QCM</p>
				<div id="part_form">
				<p>Sujet du QCM</p>

			
					<input type="text" name="nom" required placeholder="Titre"/>
					<br>
					<input type="text" name="enonce" required placeholder="Énoncé"/>
					<br>

					<p>Thème</p>
					<a>Le thème correspond à un cours enregistré dans une des matières que vous enseignez</a>

					<?php 

						$path=array('model','ModelCours.php');
						require_once File::build_path($path);

						$tab_cours = ModelCours::selectAll();

						$tab_nom_cours=array();
						$tab_code_cours=array();

						foreach ($tab_cours as $cours) {
								
							array_push($tab_nom_cours,$cours->get("nomCours"));
							array_push($tab_code_cours,$cours->get("codeCours"));

						}

		


					?>

					<select name="code" required />

						<?php

						foreach($tab_nom_cours as $value) {


						  echo '<option value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
					
						  next($tab_code_cours);
						}

						?> 


					</select>
					<br>
					<br>
					<p>Questions</p>
					<label>Proposition 1</label>
					<input type="text" name="proposition_1" required placeholder="Proposition 1"/>
					<br>
					<label>Proposition 2</label>
					<input type="text" name="proposition_2" required placeholder="Proposition 2"/>
					<br>
					<label>Proposition 3</label>
					<input type="text" name="proposition_3" required placeholder="Proposition 3"/>
					<br>
					<label>Proposition 4</label>
					<input type="text" name="proposition_4" required placeholder="Proposition 4"/>
					<br> 
					<label>Proposition correcte</label>
					<input type="number" name="reponse_juste" required placeholder="N° réponse juste"/>
					<br>
				</div>	
				<input type="submit" value="Soumettre le QCM"/>
				<br>
			</form>




</article>

