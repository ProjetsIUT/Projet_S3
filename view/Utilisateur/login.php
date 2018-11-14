

		<article id="page_connexion">


				<form id="formulaire_connexion" methode="get" action=<?php echo '"'.(File::build_path(array('lib','connect.php'))).'"'; ?>>

					<p>Connexion à Agora</p>
					<?php if(isset($code) && $code==='error_mdp'){echo '<a style="color:red;">Mot de passe erroné</a>';}?>
					<?php if(isset($code) && $code==='error_user'){echo '<a style="color:red;">Utilisateur non inscrit</a>';}?>
					<br>
					<br>
					<div id="part_form">


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
			
