

		<article id="page_connexion">


				<form id="formulaire_connexion" methode="get" action=<?php echo '"'.(File::build_path(array('index.php'))). '"'; ?>>

					<p>Connexion à Agora</p>
					<?php if(isset($code_connect_failed) && $code_connect_failed==='error_mdp'){echo '<a style="color:#6e0000;">Mot de passe erroné</a>';}?>
					<?php if(isset($code_connect_failed) && $code_connect_failed==='error_user'){echo '<a style="color:#6e0000;">Utilisateur non inscrit</a>';}?>
					<br>
					<br>
					<div id="part_form">

						<input type="hidden" name="controller" value="utilisateurs" />
						<input type="hidden" name="action" value="connect" />
						<input type="text" name="login" required placeholder="Nom d'utilisateur"/>
						<br>
						<br>
						<input type="password" name="password" required placeholder="Mot de passe"/>
						<br>
					
						
					</div>	

					<input type="submit" value="Se connecter"/>

					<br>
                    <br>
					<a>Mot de passe oublié ?</a>



				</form>


		</article>
			
