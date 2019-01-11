
	<div class="page_content" id="div_page_perso_enseignant">

		<div class="ligne">

			<div class="tab" id="tab_profil">

				<h3>Bienvenue sur Agora</h3>
				<br>
				<?php 
           		if(isset($error_page)) {
                	echo '<h3 style="color:#E70739;"> '.$error_page.' </h3> <br>';
            	}
            	?>
				<a>Bonjour, <?php echo $_SESSION["prenomUtilisateur"]?></a>
				<br>
				<a>Vous utilisez la version Alpha d'Agora. Certaines fonctionnalités ne sont pas encore disponibles.</a>
			</div>


			<div class="tab" id="tab_cours">
 
				<h3>Mes cours <a href="./index.php?controller=cours&action=list" class="bouton"> Tous mes cours</a></h3>
				<br>

				<?php

				$cours = current($tab_cours);

				for($i=0;$i<5;$i++){
						
						if($cours!=false){

							echo('

								<a>'.$cours->get('nomCours').'</a>
								<a class=note href='.$cours->get('fichierCours').'>Consulter</a>
										<a class=note href="./index.php?controller=cours&action=suppr&code='.$cours->get('codeCours').'">Supprimer</a>
								<br>

								');


						}

						$cours=next($tab_cours);


				}

				?>

			</div>
		
		
			<div class="tab" id="tab_rappels">

				<h3>Derniers exercices reçus<a class="bouton"> Voir tout</a></h3>

			</div>

		</div>

		<div class="ligne">

			<div class="tab" id="tab_stats">

				<h3>Statistiques<a class="bouton" href="./index.php?controller=notes&action=statsEnseignant"> Plus de statistiques</a></h3>

			</div>

		</div>




	</div>

	
	
			
