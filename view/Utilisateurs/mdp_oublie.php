<article id="page_connexion">
        <form id="formulaire_connexion" method="get" action="index.php">
            <p> Récupération de mot de passe </p>
            <?php
            if(isset($code_connect_failed) && $code_connect_failed==='error_email'){
				echo '<a style="color:#6e0000;">Cette adresse email n\'est affecté à aucun de nos comptes </a>';
			}
			?>
            <input type="hidden" name="controller" value="utilisateurs" />
			<input type="hidden" name="action" value="recuparemail" />
            <a style="color:#6e0000;">Vous avez oublié votre mot de passe ? Aucun soucis nous nous occupons de vous en renvoyer un sur l'adresse mail de notre compte!</a>
            <br>
            <br>
            <input type="email" name="email" id="email_id" placeholder="example@gmail.com" required/>
            <br>
            <br>
            <input type="submit" value="Envoyer"/>
        </form>
</article>