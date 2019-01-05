<form id="formulaire_mdp_etudiant" method="post" action="index.php">
	<p>Bienvenue sur Agora</p>
	<div id="part_from">
		<?php
			if(isset($verif)) {
				echo '<a style="color:#E70739;"> '.$verif.' </a>';
			}
		?>

		<p>Vous utilisez Agora pour la première fois. Pour commencer, veuillez choisir un mot de passe sécurisé.</p>
		<br>
		<input type="hidden" name="controller" value="utilisateurs">
		<input type="hidden" name="action" value="update_password">
		<input type="hidden" name="loginUtilisateur" value=<?php echo $_GET["loginUtilisateur"]?>>
		<label>Mot de passe :</label>
		<input type="password" name="mdpUtilisateur" required>
		<br>
		<label>Confirmer le mot de passe :</label>
		<input type="password" name="vmdpUtilisateur" required>
		<br>
		<input type="submit" value="Valider">
	</div>
</form>

