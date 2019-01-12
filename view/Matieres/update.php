<div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=utilisateurs&action=readAll">Retour à la liste des utilisateurs</a></h1>
<article id="page_connexion">
    <form id="formulaire_connexion" method="get" action="index.php">
        <input type="hidden" name="action" value="updated"/>
        <input type="hidden" name="controller" value="matieres"/>
        <input type="hidden" name="loginEtudiant" value=<?php echo $_GET['loginEtudiant'] ?> />
        
        <?php 
            if($_GET['action'] === 'update') {
                echo '
                <br>
                <label for="anneencours_id">Annee en cours : </label>
                <input type="text" value="'.htmlspecialchars($uanneencours).'" name="anneencours" id="anneencours_id" required/>
                <br>
                <br>
                <label for="codedepartement_id">Code département : </label>
                <input type="number" value="'.htmlspecialchars($ucodedepartement).'" name="codedepartement" id="codedepartement_id" required/>
                <br>
                <br>
                <label for="semestreencours_id">Semestre en cours : </label>
                <input type="text" value="'.htmlspecialchars($usemestre).'" name="semestreencours" id="semestreencours_id" required/>
                <br>
                ';
            }
            else if($_GET['action'] === 'updated') {
                echo '
                <br>
                <label for="anneencours_id">Annee en cours : </label>
                <input type="text" value="'.htmlspecialchars($_GET['anneeencours']).'" name="anneencours" id="anneencours_id" required/>
                <br>
                <br>
                <label for="codedepartement_id">Code département : </label>
                <input type="number" value="'.htmlspecialchars($_GET['codedepartement']).'" name="codedepartement" id="codedepartement_id" required/>
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