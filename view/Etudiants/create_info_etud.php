<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="created_info_etud"/>
        <input type="hidden" name="controller" value="etudiants"/>
        <input type="hidden" name="loginEtudiant" value=<?php echo $_GET['loginUtilisateur'] ?> />
        
    </form>
</article>