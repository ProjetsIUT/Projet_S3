<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=departements&action=readAll">Retour à la liste des départements</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="updated"/>
        <input type="hidden" name="controller" value="departements"/>
        
         
        <?php 
            if($_GET['action'] === 'update') {
                echo '
                <br>
                <label for="codeDepartement_id"> Code département : </label>
                <input type="text" value="'.htmlspecialchars($mcodeDepartement).'" name="codeDepartement" id="codeDepartement_id" required readonly/>
                <br>
                <br>
                <label for="nomDepartement_id">Nom du département : </label>
                <input type="text" value="'.htmlspecialchars($mnomDepartement).'" name="nomDepartement" id="nomDepartement_id" required/>
                <br>
                <br>
                <label for="codeEtablissement_id">Nom Etablissement : </label>
                <select value="'.htmlspecialchars($mnomDepartement).'" name="codeEtablissement" id="codeEtablissement_id" size="1" required/>';
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
        <input type="submit" value="Terminer la modification" />
    </form>
</article>

</div>