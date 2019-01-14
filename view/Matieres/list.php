<div class=page_content>
<h1>Gestion des matières <a href="index.php?controller=matieres&action=create" class="bouton">+ Ajouter une matière</a><a class="bouton" href="./index.php?controller=matieres&action=ajoutAssociation">+Gérer les associations</a></h1>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>Voici la liste des matières, cliquez sur une matière pour la modifier</p>

    <?php
        foreach ($tab_m as $m) 
            echo ('<p> <a href="index.php?controller=matieres&action=read&codeMatiere='.rawurlencode($m->get('codeMatiere')).'" style="color:black"> Matière '.htmlspecialchars($m->get('nomMatiere')).' </a> </p>');
    ?>
</div>
</article>
</div>