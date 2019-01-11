<div class="page_content">

	<h1><?php if($tab){echo 'Liste des QCMs'; }else{ echo'Aucun QCM'; } ?> 


	<?php if(Session::is_teacher()){ echo '<a class="bouton" href="./index.php?controller=QCM&action=show_form_new">Publier un QCM</a>'; } ?></h1>



		<?php

		  if($tab){


		  	$i = 0;

			foreach ($tab as $qcm) {

				if($i==0){

					echo'<div class="ligne">';

				}
				
				$code_qcm = htmlspecialchars($qcm->get('codeQCM'));
				$nom_qcm = htmlspecialchars($qcm->get("nomQCM"));
				$theme_qcm_code = htmlspecialchars($qcm->get("themeQCM"));
				$theme_qcm_cours=ModelCours::select($theme_qcm_code);
				$theme_qcm=htmlspecialchars($theme_qcm_cours->get('nomCours'));  
				$enoncé_qcm=htmlspecialchars($qcm->get("resume"));
				$date_qcm=htmlspecialchars($qcm->get("dateQCM"));
				$fait=ModelNotes::exerciceDejaFait($code_qcm);

			
				if(Session::is_teacher()){
 
					$bouton_suppr = '<a class="bouton_suppr" href="./index.php?controller=QCM&action=suppr&code=' .$code_qcm . '">Supprimer</a> ';

				}else{

					$bouton_suppr = '';

				}

				if($fait){

					$bouton_faire = '<a class="bouton" href="./index.php?controller=notes&action=listByEtud">Voir ma note</a> ';
				

				}else{

					$bouton_faire= '<a class="bouton" href="./index.php?controller=QCM&action=afficher&code=' .$code_qcm . '">Faire le QCM</a> ';
				}

				echo '


					<div class="div_list">

					
						<h3>' . $nom_qcm . '
						   </h3>
						<br>
						<legend>Dans ' . $theme_qcm.' </legend>
						<legend>Publié le ' . $date_qcm . '</legend>
						<br>
						<div class="description">
							<a>'. $enoncé_qcm .'</a>
						</div>

						<div class="bloc_boutons">
							<h3>	
								'.$bouton_faire.'
								<a class="bouton" href="./data/'.$theme_qcm_code.'.pdf">Voir le cours</a>'.
								$bouton_suppr . '
							</h3>
						</div>



					</div>

				' ;

				$i++;


				if($i==4){

						echo'</div>';
						$i=0;

				}

				

			}



		  }
			
		?>


</div>