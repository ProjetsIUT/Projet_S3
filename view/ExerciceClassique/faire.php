<?php
    echo "<h2>$nomE</h2> <br/ >";
    echo "<p> Énoncé de l'exercice : $enonce </p>";        
?>
<form method="post" action="index.php?" id="formulaire_ajouterqcm">
            
            
            <fieldset>
            <p>
                <label for="reponse_id">Votre réponse :</label>
                <textarea name="reponse" id="reponse_id" required></textarea>
                
                <input type="hidden" name="action" value="reponse" />
                <input type="hidden" name="controller" value="ExerciceClassique" />
            </p>
            
            <p>
                <input type="submit" value="Valider" />
            </p>
            </fieldset>
</form>
