<?php
    echo "<div>";
    echo "<h2> $nomE</h2>  <br/ >";
    echo "<p> Énoncé de l'exercice : $enonce </p>"; 

    echo "<p> Reponse de l'eleve $loginEtudiant : <br /> $reponse</p>";

    echo "</div>";
?>

            <form method="post" action="index.php?" id="formulaire_ajouterqcm">
    
            <fieldset>
            
            <p>
                Note sur 20 : <br />
                <input type="number" name="note" max=20 min=0>
            </p>

            <p>
                <label for="reponse_id">Commentaires:</label>
                <textarea name="reponse" id="reponse_id" required></textarea>
                
                <input type="hidden" name="action" value="" />
                <input type="hidden" name="controller" value="Notes" />
                <input type="hidden" name="idExercice" value=<?=$id?> />

            </p>
            
            <p>
                <input type="submit" value="Valider" />
            </p>
            </fieldset>
</form>