<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=etablissements&action=readAll">Retour à la liste des établissements</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="updated"/>
        <input type="hidden" name="controller" value="etablissements"/>
        
         
        <?php 
            if($_GET['action'] === 'update') {
                echo '
                <br>
                <label for="codeEtablissement_id">Code de l\'établissement : </label>
                <input type="text" value="'.htmlspecialchars($mcodeEtablissement).'" name="codeEtablissement" id="codeEtablissement_id" required readonly/>
                <br>
                <br>
                <label for="nomEtablissement_id">Nom de l\'établissement : </label>
                <input type="text" value="'.htmlspecialchars($mnomEtablissement).'" name="nomEtablissement" id="nomEtablissement_id" required/>
                <br>
                <br>
                <label for="villeEtablissement_id">Ville de l\'établissement : </label>
                <input type="text" value="'.htmlspecialchars($mvilleEtablissement).'" name="villeEtablissement" id="villeEtablissement_id" required/>
                <br>
                ';
            }
        ?>
        <br>
        <input type="submit" value="Terminer la modification" />
    </form>
</article>

</div>