<article id="page_connexion">
<div id="formulaire_connexion">
    <h1>Gestion des utilisateurs </h1>
    <p>Voici la liste des utilisateurs, cliquez sur un utilisateur pour le modifier</p>

    <?php
        foreach ($tab_u as $u) 
            echo ('<p> <a href="index.php?controller=utilisateurs&action=read&loginUtilisateur='.rawurlencode($u->get('loginUtilisateur')).'" style="color:black"> L\''.htmlspecialchars($u->get('typeUtilisateur')).' '.htmlspecialchars($u->get('prenomUtilisateur')).' '.htmlspecialchars($u->get('nomUtilisateur')).' de login '.htmlspecialchars($u->get('loginUtilisateur')).' </a> </p>');
    ?>
    <a href="index.php?controller=utilisateurs&action=create" class="bouton">+ Ajouter un utilisateur</a>
</div>
</article>