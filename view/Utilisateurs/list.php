<div class=page_content>
<h1>Gestion des utilisateurs <a href="index.php?controller=utilisateurs&action=create" class="bouton">+ Ajouter un utilisateur</a></h1>
<article id="page_connexion">
<div id="formulaire_connexion">
    <form id=filtres method=get action=index.php>
    <input type=hidden name=controller value=utilisateurs>
	<input type=hidden name=action value=readAll>
    <select name="typeUtilisateur" required onchange="document.getElementById('filtres').submit();">
    <option value="" disabled selected><?php if(isset($_GET['typeUtilisateur'])) {
							echo $nomM;						
						}
						else {
							echo "Type d'utilisateur";
                        }
                        ?></option>
			<option value="all">Voir tout</option>
            <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant
              <option value="enseignant"> Enseignant
    </select>
    </form>
    <p>Voici la liste des utilisateurs, cliquez sur un utilisateur pour le modifier</p>
    <?php
        if(!isset($verif)) {
            foreach ($tab_u as $u) 
                echo ('<p> <a href="index.php?controller=utilisateurs&action=read&loginUtilisateur='.rawurlencode($u->get('loginUtilisateur')).'" style="color:black"> L\''.htmlspecialchars($u->get('typeUtilisateur')).' '.htmlspecialchars($u->get('prenomUtilisateur')).' '.htmlspecialchars($u->get('nomUtilisateur')).' de login '.htmlspecialchars($u->get('loginUtilisateur')).' </a> </p>');
        }
        else {
            echo '<p> '.$verif.' </p>';
        }
    ?>
</div>
</article>
</div>