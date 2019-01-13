

	<form enctype="multipart/form-data" id="formulaire_ajouterCours" method="post" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

		<input type="hidden" name="controller" value="cours" />
		<input type="hidden" name="action" value="upload_cours" />

		<p>Publier un cours</p>

		<label>Nom du cours:</label>
		<br>
		<br>
		<input type="text" name="nomCours" required>
		<br>
		<br>
		<label>Accès au cours:</label>
		<br>
		<br>
	    <input type="radio" name="accesCours" id="publique" value="1" required>
	    <label for="publique">Autoriser l'accès à tout le monde</label>
	    <br>
	    <br>
	    <input type="radio" name="accesCours" id="prive" value="0">
	    <label for="prive">Autoriser l'accès seulment aux personnes inscrites à la matière</label>
	    <br>
	    <br>
	    <label>Cours au format PDF:</label>
	    <br>
	    <br>
		<input type="file" name="fichierCours" required>
		<br>
		<br>
		<label>Matière où enregistrer le cours:</label>
		<br>
		<br>
		<select name="code" required />

						<?php

						foreach($tab_nom_matieres as $value) {


						  echo '<option value="'.current($tab_code_matieres).'"' .'>'.$value.'</option>';
					
						  next($tab_code_matieres);
						}

						?> 


		</select>
		<br>
		<label>Résumé du cours:</label>
		<br>
		<textarea name="resume">


		</textarea>

		<br>

		<br>

		<input type="submit" value="Sauvegarder le cours">



	</form>

