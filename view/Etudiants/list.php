<div class=page_content>
<h1>Gestion des étudiants</h1>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>Voici la liste des étudiants, cliquez sur un étudiant pour le modifier</p>

    <?php
        foreach ($tab_u as $u) 
            echo ('<p> <a href="index.php?controller=etudiants&action=read&loginEtudiant='.rawurlencode($u->get('loginEtudiant')).'" style="color:black"> L\'étudiant de login '.htmlspecialchars($u->get('loginEtudiant')).' </a> </p>');
    ?>
</div>
</article>
</div>