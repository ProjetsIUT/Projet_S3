<h1>Exercice</h1>

<form method="post" action="index.php?" enctype="multipart/form-data" id="formulaire_ajouterqcm">

<?php
    echo "<p>$nomE </p>";
    echo "<a>Énoncé de l'exercice : <br> $enonce </a><br>"; 
?>

            
            
            
 
                <label for="reponse_id">Votre réponse :</label> <br>
                <textarea name="reponse" id="reponse_id" required></textarea>

                <p> Ajouter un fichier : </p> <br />
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                <input type="file" name="fichier" >


                
                <input type="hidden" name="action" value="reponse" />
                <input type="hidden" name="controller" value="FaireExercice" />
                <input type="hidden" name="idExercice" value=<?=$id?> />

       
            
            <p>
                <input type="submit" value="Valider" />
            </p>
            
</form>
