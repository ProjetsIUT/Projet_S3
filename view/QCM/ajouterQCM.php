<<<<<<< HEAD
<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

				<input type="hidden" name="controller" value="QCM" />
				<input type="hidden" name="action" value="show_form_new_questions" />


				<p>Formulaire de création de QCM</p>
				<div id="part_form">
				<p>Sujet du QCM</p>

			
					<input type="text" name="nom" required placeholder="Titre"/>
					<br>
					<input type="text" name="resume" required placeholder="Resumé"/>
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

					<select name="theme" required />

						<?php

						foreach($tab_nom_cours as $value) {


						  echo '<option value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
					
						  next($tab_code_cours);
						}

						?> 


					</select>
					<br>
					<br>

				<label>Nombre de questions</label>
				<input type=number name="nbQuestions" min=2 max=20 value="5">					
				</div>	
				<input type="submit" value="Suivant (questions)"/> 
				<br>
			</form>




</article>

=======
<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

				<input type="hidden" name="controller" value="QCM" />
				<input type="hidden" name="action" value="show_form_new_questions" />


				<p>Formulaire de création de QCM</p>
				<div id="part_form">
				<p>Sujet du QCM</p>

			
					<input type="text" name="nom" required placeholder="Titre"/>
					<br>
					<input type="text" name="resume" required placeholder="Resumé"/>
					<br>

					<p>Thème</p>
					<a>Le thème correspond à un cours enregistré dans une des matières que vous enseignez</a>

					<?php 

						$path=array('model','ModelCours.php');
						require_once File::build_path($path);

						$tab_cours = ModelCours::getAllByEnseignant();

						$tab_nom_cours=array();
						$tab_code_cours=array();

						foreach ($tab_cours as $cours) {
								
							array_push($tab_nom_cours,$cours->get("nomCours"));
							array_push($tab_code_cours,$cours->get("codeCours"));

						}

					?>

					<select name="theme" required />

						<?php

						foreach($tab_nom_cours as $value) {


						  echo '<option value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
					
						  next($tab_code_cours);
						}

						?> 


					</select>
					<br>
					<br>

				<label>Nombre de questions</label>
				<input type=number name="nbQuestions" min=2 max=20 value="5">					
				</div>	
				<input type="submit" value="Suivant (questions)"/> 
				<br>
			</form>




</article>

>>>>>>> master
