<form id="formulaire_mdp_etudiant" method="post" action="index.php">
	<p>Bienvenue sur Agora</p>
	<div id="part_from">
		<p>Vous utilisez Agora pour la première fois. Pour commencer, veuillez choisir un mot de passe sécurisé.</p>
		<br>
		<input type="hidden" name="controller" value="utilisateurs">
		<input type="hidden" name="action" value="update_password">
		<input type="hidden" name="login" value=<?php echo $_GET["login"]?>>
		<label>Mot de passe</label><br>
		<input type="password" name="new_password" required>
		<br>
		<br>
		<input type="submit" value="Valider">
	</div>
</form>

