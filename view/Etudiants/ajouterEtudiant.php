<form id="formulaire_mdp_etudiant" method="post" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>


	<p>Bienvenue sur Agora</p>
	<div id="part_from">

		<p>Vous utilisez Agora pour la première fois. Pour commencer, veuillez choisir un mot de passe sécurisé à associer à votre compte</p>

		<input type="hidden" name="controller" value="etudiant">
		<input type="hidden" name="action" value="update_password">
		<label>Mot de passe</label>
		<input type="password" name="new_password" required> 
		<label>Confirmer</label>
		<input type="password_confirm" name="new_password" required> 
		<input type="submit" value="Valider">

	</div>
	 



</form>