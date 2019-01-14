<div class=page_content>
<h1>Gestion des départements <a href="index.php?controller=departements&action=create" class="bouton">+ Ajouter un département</a></h1>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>Voici la liste des départements, cliquez sur un département pour le modifier</p>

    <?php
        foreach ($tab_d as $d) 
            echo ('<p> <a href="index.php?controller=departements&action=read&codeDepartement='.rawurlencode($d->get('codeDepartement')).'" style="color:black"> Département  '.htmlspecialchars($d->get('nomDepartement')).' </a> </p>');
    ?>
</div>
</article>
</div>