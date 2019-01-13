<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=utilisateurs&action=readAll">Retour à la liste des utilisateurs</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="created_info_etud"/>
        <input type="hidden" name="controller" value="etudiants"/>
        <input type="hidden" name="loginEtudiant" value=<?php echo $_GET['loginUtilisateur'] ?> />
        
        <?php 
            if($_GET['action'] === 'create_info_etud') {
                echo '
                <br>
                <label for="anneencours_id">Annee en cours : </label>
                <input type="text" placeholder="Année X" name="anneencours" id="anneencours_id" required/>
                <br>
                <br>
                <label for="codedepartement_id">Département : </label>
                <select name="codedepartement" id="codedepartement_id" size="1" required/>';
                foreach ($tab_d as $d) {
                    echo '<option value="'.htmlspecialchars($d->get('codeDepartement')).'"> '.htmlspecialchars($d->get('nomDepartement')).'';
                }
                echo '
                </select>
                <br>
                <br>
                <label for="semestreencours_id">Semestre en cours : </label>
                <input type="text" placeholder="Semestre X" name="semestreencours" id="semestreencours_id" required/>
                <br>
                ';
            }
            else if($_GET['action'] === 'created_info_etud') {
                echo '
                <br>
                <label for="anneencours_id">Annee en cours : </label>
                <input type="text" value="'.htmlspecialchars($_GET['anneeencours']).'" name="anneencours" id="anneencours_id" required/>
                <br>
                <br>
                <label for="codedepartement_id">Code département : </label>
                <select value='.htmlspecialchars($_GET['codeDepartement']).' name="codedepartement" id="codedepartement_id" size="1" required/>';
                foreach ($tab_d as $d) {
                    echo '<option value="'.htmlspecialchars($d->get('codeDepartement')).'"> '.htmlspecialchars($d->get('nomDepartement')).'';
                }
                echo '
                </select>
                <br>
                <br>
                <label for="semestreencours_id">Semestre en cours : </label>
                <input type="text" value="'.htmlspecialchars($_GET['semestreencours']).'" name="semestreencours" id="semestreencours_id" required/>
                <br>
                ';
            }
        ?>
        <br>
        <input type="submit" value="Terminer l'inscription" />
    </form>
</article>

</div>