<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=etablissements&action=readAll">Retour à la liste des établissements</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="created"/>
        <input type="hidden" name="controller" value="etablissements"/>
        
         
        <?php 
            if($_GET['action'] === 'create') {
                echo '
                <br>
                <label for="nomEtablissement_id">Nom de l\'établissement : </label>
                <input type="text" placeholder="Faculté de pharmacie" name="nomEtablissement" id="nomEtablissement_id" required/>
                <br>
                <br>
                <label for="villeEtablissement_id">Ville de l\'établissement : </label>
                <input type="text" placeholder="Montpellier" name="villeEtablissement" id="villeEtablissement_id" required/>
                <br>
                ';
            }
        ?>
        <br>
        <input type="submit" value="Terminer l'ajout" />
    </form>
</article>

</div>