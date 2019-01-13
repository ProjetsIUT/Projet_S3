<form id="formulaire_mdp_etudiant" method="get" action="./index.php">


	<p>Ajouter une association</p>
	<div id="part_from">

		<p>Vous pouvez inscrire ici un enseignant ou un étudiant dans une matière</p>

		<input type="hidden" name="controller" value="matieres">
		<input type="hidden" name="action" value="addAssociation">



						<a> Choisir un utilisateur:</a>
						<select name="user">
							
							<?php 

								foreach ($tab_users as $u) {
									
									echo '

										<option value="'.$u->get('loginUtilisateur').'">'. $u->get('prenomUtilisateur') . ' ' . $u->get('nomUtilisateur') . '
										 de login ' . $u->get('loginUtilisateur') . '</option>

									';
								}

							?>

						</select>
						<br>

						<a> Choisir une matière à affecter</a> 

						<select name="matiere" >
							
							<?php 


								foreach ($tab_matieres as $m) {


									$dpt = ModelDepartements::select($m->get('codeDepartement'));
									$nomDpt=$dpt->get('nomDepartement');

									$etb = ModelEtablissements::select($dpt->get('codeEtablissement'));
									$nomEtb = $etb->get('nomEtablissement');


									
									echo '

										<option value="'.$m->get('codeMatiere').'">'. $m->get('nomMatiere') . ' dans le département ' .$nomDpt .' de l\'établissement '. $nomEtb . '
										</option>

									';
								}

							?>

						</select>
					</div>

					<input type="submit" value="Ajouter">

		</form>
