<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

				<input type="hidden" name="controller" value="QCM" />
				<input type="hidden" name="action" value="save_qcm" />


				<input type="hidden" name="nom" value=<?php echo('"'.$_GET['nom'].'"')?> >
				<input type="hidden" name="resume" value=<?php echo('"'.$_GET['resume'].'"')?> >
				<input type="hidden" name="theme" value=<?php echo('"'.$_GET['theme'].'"')?> >
				<input type="hidden" name="nbQuestions" value=<?php echo($_GET['nbQuestions'])?> >





				<p>Nouveau QCM</p>



					<?php

						echo('<a class="p_form">Nom du QCM : '.$_GET['nom'].'</a><br><br>');


						$c=$_GET['nbQuestions'];

 
						for($i=1;$i<=$c;$i++){ 

							echo('
								<div id="part_form">
								<label class="p_form">Question'. $i . '</label>
								<br>
								<input id="input_enonce" name="enonce_question'.$i.'"type=text placeholder="Enoncé de la question" required >
								<input name="proposition1_question'.$i.'" type=text  placeholder="Proposition1" required>
								<br>
								<input name="proposition2_question'.$i.'" type=text placeholder="Proposition2"required>
								<input name="proposition3_question'.$i.'" type=text  placeholder="Proposition3" required>
								<input name="proposition4_question'.$i.'" type=text  placeholder="Proposition4" required>
								<br>
								<br>
								<label id="label_proposition_correcte">Proposition correcte:</label>
								<br>
								<input name="propositionCorrecte_question'.$i.'" type=number min=1 max=4 value="1" required>
								<br>
								</div>


							');

						}



					?>
				<input type="submit" value="Enregistrer le QCM"/> 
				<br>
			</form>




</article>

