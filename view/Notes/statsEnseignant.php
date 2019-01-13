<div class="page_content">

	<h1>Statistiques</h1>

	<div class="box_center">

		<form id="filtres" method=get action="./index.php">

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

				<select name="codeMatiere" required onchange="document.getElementById('filtres').submit();" />

						<option value="" disabled selected>Matiere</option>
						<option value="all">Voir tout</option>


						<?php

							foreach($tab_nom_matieres as $value) {

							  if(isset($_GET['codeMatiere']) && $_GET['codeMatiere']===current($tab_codesMatieres)){

							  	$selected = 'selected';

							  }else{

							  	$selected='';
							  }

							  echo '<option '.$selected.' value="'.current($tab_codesMatieres).'"' .'>'.$value.'</option>';
						
							  next($tab_codesMatieres);
							}

						?> 


				</select>

				<select name="codeEtudiant" required  onchange="document.getElementById('filtres').submit();" />

						<option value="" disabled selected>Etudiant</option>
						<option value="all">Voir tout</option>

						<?php

							$tab_login_etudiants=ModelEtudiants::getAllByEnseignant();
				

							foreach($tab_login_etudiants as $value) {

							  $etudiant=ModelUtilisateurs::select($value);
							  $nomEtudiant=$etudiant->get('nomUtilisateur');
							  var_dump($nomEtudiant);
							  $prenomEtudiant=$etudiant->get('prenomUtilisateur');
							  $nomPrenomEtudiant=$prenomEtudiant . " " . $nomEtudiant;

							  if(isset($_GET['codeEtudiant']) && $_GET['codeEtudiant']===$value){

							  	$selected = 'selected';

							  }else{

							  	$selected='';
							  }

							  echo '<option '.$selected.' value="'.$value.'"' .'>'.$nomPrenomEtudiant.'</option>';
						   

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
						<option value="all">Voir tout</option>

						<?php

							foreach($tab_nom_cours as $value) {

							  if(isset($_GET['codeCours']) && $_GET['codeCours']===current($tab_code_cours)){

							  	$selected = 'selected';

							  }else{

							  	$selected='';
							  }

							  
							  echo '<option '.$selected.' value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
						
							  next($tab_code_cours);
							}

						?> 


					</select>

					<input type=hidden name=controller value=notes>
					<input type=hidden name=action value=statsEnseignant>
					<br>
					<br>
					<label>Intervalle en jours:</label>
					<input id="input_intervalle" value="7" type=number min=1 max=365 name="intervalle" required onchange="document.getElementById('filtres').submit();">

		</form>



	 <div class="center_content">


	 		<br>

	 		<?php 

		 		if(isset($_GET['codeEtudiant']) && isset($_GET['codeCours']) && $_GET['codeCours']!='all' && $_GET['codeEtudiant']!='all'){

		 					$cours=ModelCours::select($_GET['codeCours']);
		 					$nomCours=$cours->get('nomCours');


		 					echo'	

		 						<a>Moyenne de l\'étudiant '.$_GET['codeEtudiant'].' au cours '. $nomCours . '
		 						<br>
		 						<img class="graph" src="./view/Notes/graphes/moyenneCours.php">
		 						<br>';

		 		}


		 		if(isset($_GET['codeMatiere']) && isset($_GET['codeEtudiant']) && $_GET['codeMatiere']!='all' && $_GET['codeEtudiant']!='all'){

		 					$matiere=ModelMatieres::select($_GET['codeMatiere']);
		 					$nomMatiere=$matiere->get('nomMatiere');
 

		 					echo'	


		 						<a>Moyenne de l\'étudiant '.$_GET['codeEtudiant'].' en '. $nomMatiere . '
		 						<br>
		 						<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">
		 						<br>';


		 		}



		 		if(isset($_GET['codeCours'])){

		 			if($_GET['codeCours']!='all'){

		 			$cours=ModelCours::select($_GET['codeCours']);
		 			$nomCours=$cours->get('nomCours');

		 			echo'	

		 				<a>Moyenne générale de la promotion au cours '.$nomCours .'
		 				<br>
		 				<img class="graph" src="./view/Notes/graphes/moyenneCours.php">
		 				<br>';

		 			}else{


		 			echo'	

		 				<a>Moyenne générale de la promotion dans toutes les matières
		 				<br>
		 				<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">
		 				<br>';

		 			}
		 		}


		 		if(isset($_GET['codeMatiere']) && !isset($_GET['codeEtudiant']) ){

		 			if ($_GET['codeMatiere']!='all'){

		 			$matiere=ModelMatieres::select($_GET['codeMatiere']);
		 			$nomMatiere=$matiere->get('nomMatiere');
 

		 			echo'	

		 				<a>Moyenne générale de la promotion en '.$nomMatiere .'
		 				<br>
		 				<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">
		 				<br>';

		 			}else{

		 				echo'
		 				<a>Moyenne générale de la promotion dans toutes les matières
		 				<br>
		 				<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">
		 				<br>';


		 			}
		 		}


		 		if(isset($_GET['codeEtudiant']) && $_GET['codeEtudiant']!='all'&& !isset($_GET['codeCours']) && !isset($_GET['codeMatiere'])){

		 			echo'	

		 				<a>Moyenne générale de l\'étudiant '.$_GET['codeEtudiant'].'
		 				<br>
		 				<img class="graph" src="./view/Notes/graphes/moyenne.php">
		 				<br>';

		 		}

	 		?>


	 		

	<div>

	</div>	

</div>