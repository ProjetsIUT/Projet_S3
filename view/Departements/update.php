<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=matieres&action=readAll">Retour à la liste des matières</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="updated"/>
        <input type="hidden" name="controller" value="matieres"/>
        
         
        <?php 
            if($_GET['action'] === 'update') {
                echo '
                <label for="codeMatiere_id"> Code matière : </label>
                <input type="text" value='.htmlspecialchars($mcodematiere).'name="codeMatiere" id="codeMatiere_id" required/>
                <br>
                <br>
                <label for="nomMatiere_id">Nom de la matière : </label>
                <input type="text" value='.htmlspecialchars($mnommatiere).'name="nomMatiere" id="nomMatiere_id" required/>
                <br>
                <br>
                <label for="codeDepartement_id">Département : </label>
                <select name="codeDepartement" value='.htmlspecialchars($mcodeDepartement).'id="codeDepartement_id" size="1" required/>';
                foreach ($tab_d as $d) {
                    echo '<option value='.htmlspecialchars($d->get('codeDepartement')).'> '.htmlspecialchars($d->get('nomDepartement')).'';
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