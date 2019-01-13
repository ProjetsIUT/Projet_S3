<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=departements&action=readAll">Retour à la liste des departements</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="created"/>
        <input type="hidden" name="controller" value="departements"/>
        
         
        <?php 
            if($_GET['action'] === 'create') {
                echo '
                <br>
                <label for="nomDepartement_id">Nom du département : </label>
                <input type="text" placeholder="Informatique" name="nomDepartement" id="nomDepartement_id" required/>
                <br>
                <br>
                <label for="codeEtablissement_id">Nom Etablissement : </label>
                <select name="codeEtablissement" id="codeEtablissement_id" size="1" required/>';
                foreach ($tab_e as $e) {
                    echo '<option value='.htmlspecialchars($e->get('codeEtablissement')).'> '.htmlspecialchars($e->get('nomEtablissement')).'';
                }
                echo '
                </select>
                <br>
                ';
            }
        ?>
        <br>
        <input type="submit" value="Terminer l'ajout" />
    </form>
</article>

</div>