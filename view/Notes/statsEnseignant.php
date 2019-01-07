<div class="page_content">

	<h1>Statistiques</h1>

	<div class="box_center">

		<form id=filtres method=get action="./index.php">

				<input type=hidden name=controller value=notes>
				<input type=hidden name=action value=statsEnseignant>
				<label>Filtrer par: </label>
				<?php 

						$tab_codesMatieres = ModelMatieres::getAllByEnseignant();
						$tab_nom_matieres=array();
	

						foreach ($tab_codesMatieres as $codeMatiere) {

							$matiere=ModelMatieres::select($codeMatiere);
							array_push($tab_nom_matieres,$matiere->get("nomMatiere"));


						}

				?>
 
				<select name="codeMatiere" required  onchange="document.getElementById('filtres').submit();">

						<option value="" disabled selected>Matiere</option>
						<option value="all">Voir tout</option>

						<?php

							foreach($tab_nom_matieres as $value) {

							  echo '<option value="'.current($tab_codesMatieres).'"' .'>'.$value.'</option>';
						
							  next($tab_codesMatieres);
							}

						?> 


				</select>


					<?php 


						$tab_cours = ModelCours::getAllByEnseignant();

						$tab_nom_cours=array();
						$tab_code_cours=array();

						foreach ($tab_cours as $cours) {
								
							array_push($tab_nom_cours,$cours->get("nomCours"));
							array_push($tab_code_cours,$cours->get("codeCours"));

						}

					?>

					<select name="codeCours" required placeholder="Cours" onchange="document.getElementById('filtres').submit();" />

						<option value="" disabled selected>Cours</option>

						<?php

							foreach($tab_nom_cours as $value) {


							  echo '<option value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
						
							  next($tab_code_cours);
							}

						?> 


					</select>

		</form>


		<h2>

			<form id=form method=get class="form_filtres" action="./index.php">
					<input type=hidden name=controller value=notes>
					<input type=hidden name=action value=statsEnseignant>
					<label>Intervalle en jours:</label>
					<input id="input_intervalle" type=number min=1 max=365 name="intervalle" required>
					<img id="icon_refresh" src="./img/icones/refresh.png"  onclick="document.getElementById('form').submit();">


		</form>
		<br>

		</h2>


		


	 <div class="center_content">


	 		<br>

	 		<?php if(isset($_GET['codeCours'])){

	 			echo'	<img class="graph" src="./view/Notes/graphes/moyenneCours.php">';
	 		}

	 		?>

	 		<br>

			<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">


	<div>

	</div>	

</div>