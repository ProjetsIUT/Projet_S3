        <form method="post" action="index.php" enctype="multipart/form-data">
            <fieldset>
            <legend>My form:</legend>
		<p>
                    <label for="nomExercice_id">Nom de l'exercice</label> :
                    <input type="text" name="nomExercice" id="nomExercice_id" required/>
		</p>
                <p>	
                    <label for="difficulte_id">Difficulté :</label>
                    <SELECT name="difficulte" id="difficulte_id" size="1">
                    <OPTION value="facile">Facile
                    <OPTION value="moyen">Moyen
                    <OPTION value="avancé">Avancé
                    </SELECT>
		</p>
                <p>	
                    <label for="acces_id">Choisir si l'exercice est privé ou public :</label>
                    <SELECT name="acces" id="acces_id" size="1">
                        <OPTION value="1">Public
                        <OPTION value="0">Privé 
                    </SELECT>
		</p>
                <p>
                    <label for='tempsLimite_id'>Choisir une date limite</label>
                    <input type="date" name="tempsLimite" id="tempsLimite_id" />
                </p>
                <p>
                    <label for="coeff_id">Coefficient :</label>
                    <input type="number" name="coeff" id="coeff_id" />
                </p>
                <p>
                    <label for="ennonce_id">Ennoncé de l'exercice :</label>
                    <textarea name="ennonce" id="ennonce_id" required></textarea>
                </p>
                <p>
                    <label for="correction_id">Correction (max 1mo)</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="correction" id="correction_id">
                </p>


		<p>
                    <input type='hidden' name='action' value='created'>
                    <input type="submit" value="Submit" />
		</p>
            </fieldset> 
	</form>
