
<article id="page_connexion"> 
		<form id="formulaire_connexion" methode="get" action="index.php">
			<p>Connexion à Agora</p>
			<?php 
			if(isset($code_connect_failed) && $code_connect_failed==='error_mdp'){
				echo '<a style="color:#E70739;">Mauvais mot de passe</a>';
			}
			else if(isset($code_connect_failed) && $code_connect_failed==='error_user') {
				echo '<a style="color:#E70739;">Nom d\'utilisateur inexistant</a>';
			}
			else if(isset($code_connect_failed) && $code_connect_failed === 'error_compte_invalide') {
				echo '<a style="color:#E70739;">Vous n\'avez pas validé votre email</a>';
			}
			else {
				echo '<a style="color:#6e0000;">Bienvenue sur Agora</a>';
			}
			?>
			<br>
			<br>
			<div id="part_form">
				<input type="hidden" name="controller" value="utilisateurs" />
				<input type="hidden" name="action" value="connect" />
				<input type="text" name="loginUtilisateur" required placeholder="Nom d'utilisateur"/>
				<br>
				<br>
				<input type="password" name="mdpUtilisateur" required placeholder="Mot de passe"/>
				<br>		
			</div>	
			<input type="submit" value="Se connecter"/>
			<br>
			<br>
			<a href="index.php?action=mdp_oublie&controller=utilisateurs">Mot de passe oublié ?</a>
		</form>
</article>



		

