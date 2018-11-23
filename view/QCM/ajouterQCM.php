<<<<<<< HEAD

<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

				<input type="hidden" name="controller" value="QCM" />
				<input type="hidden" name="action" value="save_qcm" />


				<p>Formulaire de création de QCM</p>
				<div id="part_form">
				<p>Saisissez l'énoncé du QCM</p>

			
					<input type="text" name="nom" required placeholder="Donner un nom au QCM"/>
					<br>
					<input type="text" name="enonce" required placeholder="Saisir l'énoncé"/>
					<br>
					<br>
					<p>Saisissez la première proposition</p>
					<input type="text" name="proposition_1" required placeholder="Proposition 1"/>
					<br>
					<p>Saisissez la deuxième proposition</p>
					<input type="text" name="proposition_2" required placeholder="Proposition 2"/>
					<br>
					<p>Saisissez la troisième proposition</p>
					<input type="text" name="proposition_3" required placeholder="Proposition 3"/>
					<br>
					<p>Saisissez la quatrième proposition</p>
					<input type="text" name="proposition_4" required placeholder="Proposition 4"/>
					<br> 
					<p>Indiquez le numéro de la réponse juste</p>
					<input type="number" name="reponse_juste" required placeholder="copier/coller la réponse juste"/>
					<br>
				</div>	
				<input type="submit" value="Soumettre le QCM"/>
				<br>
			</form>










</article>

=======

<article id="page_ajouterqcm">


			<form id="formulaire_ajouterqcm" methode="get" action="ajouterQCM.php">
				<p>Formulaire de création de QCM</p>
				<div id="part_form">
					<p>Saisissez l'énoncé du QCM</p>
					<input type="text" name="code" required placeholder="Donner un code au QCM"/>
					<br>
					<input type="text" name="nom" required placeholder="Donner un nom au QCM"/>
					<br>
					<input type="text" name="enonce" required placeholder="Saisir l'énoncé"/>
					<br>
					<br>
					<p>Saisissez la première proposition</p>
					<input type="text" name="proposition_1" required placeholder="Proposition 1"/>
					<br>
					<p>Saisissez la deuxième proposition</p>
					<input type="text" name="proposition_2" required placeholder="Proposition 2"/>
					<br>
					<p>Saisissez la troisième proposition</p>
					<input type="text" name="proposition_3" required placeholder="Proposition 3"/>
					<br>
					<p>Saisissez la quatrième proposition</p>
					<input type="text" name="proposition_4" required placeholder="Proposition 4"/>
					<br> 
					<p>Resaisissez à l'espace près la réponse juste</p>
					<input type="text" name="reponse_juste" required placeholder="copier/coller la réponse juste"/>
					<br>
				</div>	
				<input type="submit" value="Soumettre le QCM"/>
				<br>
			</form>










</article>

>>>>>>> AdrienDev
