
<article id="page_connexion">
	<form id="formulaire_mdp_etudiant" method="get" action="index.php">
		<p>Bienvenue sur Agora</p>
		<div id="part_from">
			<?php
				if(isset($verif)) {
					echo '<a style="color:#E70739;"> '.$verif.' </a>';
				}
			?>
			<a style="color:#6e0000;">Vous utilisez Agora pour la première fois. Pour commencer, veuillez choisir un mot de passe sécurisé.</a>
			<br>
			<input type="hidden" name="controller" value="utilisateurs">
			<input type="hidden" name="action" value="validate_new_password">
			<input type="hidden" name="loginUtilisateur" value=<?php echo $_GET["loginUtilisateur"]?>>
			<input type="hidden" name="nonce" value=<?php echo $_GET["nonce"]?>>
			<label>Mot de passe :</label>
			<input type="password" name="mdpUtilisateur" required>
			<br>
			<label>Confirmer le mot de passe :</label>
			<input type="password" name="vmdpUtilisateur" required>
			<br>
			<input type="submit" value="Valider">
		</div>
	</form>
</article>

