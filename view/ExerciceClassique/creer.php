
        <form method="post" action="index.php?" enctype="multipart/form-data" id="formulaire_ajouterqcm">
            
            <p>Nouvel exercice</p>
		          <div id="part_form">
                    <p class="p_form">Nom de l'exercice</p>
                    <input type="text" name="nomExercice"  required/> <br>
		

        
                   <p class="p_form">Thème</p>
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

                    <br>
               

		
                
                    <p class="p_form" for='tempsLimite_id'>Choisir une date limite de rendu</p>
                    <input type="date" name="tempsLimite" id="tempsLimite_id" />
                    <br>
                
                
                    <p class="p_form" for="enonce_id">Ennoncé de l'exercice</p>
                    <textarea name="enonce" required></textarea>
                    <br>
                
                

                    <p class="p_form">Fichier de Correction (pdf) </p>

                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="correction" id="correction_id">
                
                <input type="hidden" name="action" value="created" />
                <input type="hidden" name="controller" value="ExerciceClassique" />

                <br> <br>		
                    <input type="submit" value="Valider" />

                </div id="part_form">
		
            
	</form>
