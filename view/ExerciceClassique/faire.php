<?php
    echo "<h2>$nomE</h2> <br/ >";
    echo "<p> Ennoncé de l'exercice : $ennonce </p>";        
?>
<form method="post" action="index.php?" id="formulaire_ajouterqcm">
            <fieldset>
               
            <p>
                <label for="reponse_id">Votre réponse :</label>
                <textarea name="reponse" id="reponse_id" required></textarea>
            </p>
            </fieldset>
</form>
