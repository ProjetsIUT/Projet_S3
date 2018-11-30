<?php
    echo "<h2>$nomE</h2> <br/ >";
    echo "<p> Énoncé de l'exercice : $enonce </p>"; 
    $id = $_GET['id'];
    echo "$id";
?>
<form method="post" action="index.php?" id="formulaire_ajouterqcm">
            
            
            <fieldset>
            <p>
                <label for="reponse_id">Votre réponse :</label>
                <textarea name="reponse" id="reponse_id" required></textarea>
                
                <input type="hidden" name="action" value="reponse" />
                <input type="hidden" name="controller" value="FaireExercice" />
                <input type="hidden" name="idExercice" value=<?=$id?> />

            </p>
            
            <p>
                <input type="submit" value="Valider" />
            </p>
            </fieldset>
</form>
