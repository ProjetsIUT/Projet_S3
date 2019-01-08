
        <form method="post" action="index.php?" enctype="multipart/form-data" id="formulaire_ajouterqcm">
            <fieldset>
            <legend>Creer un exercice :</legend>
		<p>
                    <label for="nomExercice_id">Nom de l'exercice</label> :
                    <input type="text" name="nomExercice" id="nomExercice_id" required/>
		</p>

        <p>Thème</p>
                    <a>Le thème correspond à un cours enregistré dans une des matières que vous enseignez</a>
                    <br>

                    <?php 

                        $path=array('model','ModelCours.php');
                        require_once File::build_path($path);

                        $tab_cours = ModelCours::selectAll();

                        $tab_nom_cours=array();
                        $tab_code_cours=array();

                        foreach ($tab_cours as $cours) {
                                
                            array_push($tab_nom_cours,$cours->get("nomCours"));
                            array_push($tab_code_cours,$cours->get("codeCours"));

                        }

                    ?>

                    <select name="theme" required />

                        <?php

                        foreach($tab_nom_cours as $value) {


                          echo '<option value="'.current($tab_code_cours).'"' .'>'.$value.'</option>';
                    
                          next($tab_code_cours);
                        }

                        ?> 


                    </select>
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
                    <SELECT name="acces" id="acces_id" size="1" required>
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
                    <label for="enonce_id">Ennoncé de l'exercice :</label>
                    <textarea name="enonce" id="enonce_id" required></textarea>
                </p>
                <p>

                    <label for="correction_id">Correction (max 1mo)</label>

                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="correction" id="correction_id">
                </p>
                <input type="hidden" name="action" value="created" />
                <input type="hidden" name="controller" value="ExerciceClassique" />

		<p>
                    <input type="submit" value="Valider" />
		</p>
            </fieldset> 
	</form>
