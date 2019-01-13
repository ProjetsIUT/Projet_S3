<div class=page_content>
<h1>Gestion des établissements <a href="index.php?controller=etablissements&action=create" class="bouton">+ Ajouter un établissement</a></h1>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>Voici la liste des établissements, cliquez sur un établissement pour le modifier :</p>

    <?php
        foreach ($tab_e as $e) 
            echo ('<p> <a href="index.php?controller=etablissements&action=read&codeEtablissement='.rawurlencode($e->get('codeEtablissement')).'" style="color:black"> Etablissement '.htmlspecialchars($e->get('nomEtablissement')).' </a> </p>');
    ?>
</div>
</article>
</div>