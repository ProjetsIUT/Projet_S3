<article id="page_connexion">
    <form id="formulaire_connexion" methode="get" action="index.php">
        <a style="color:#6e0000;">Choisissez un mot de passe sécurisé et différent de ceux que vous utilisez pour les autre sites</a>
        <input type="hidden" name="controller" value="utilisateurs" />
		<input type="hidden" name="action" value="changemdpfait" />
        <input type="hidden" name="loginUtilisateur" value=<?php $_GET['loginUtilisateur']?>/>
        <label id="mdp_id">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp_id"/>
        <br>
        <br>
        <label id="vmdp_id">Nouveau mot de passe :</label>
        <input type="password" name="vmdp" id="vmdp_id"/>
        <br>
        <br>
        <input type="submit" value="Envoyer"/>
    </form>
</article>