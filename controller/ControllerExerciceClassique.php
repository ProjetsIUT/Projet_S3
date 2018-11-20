<?php

require_once (File::build_path(array('model','ModelExerciceClassique.php')));

Class ControllerExerciceClassique {
    
    public static function creerExercice()
    {
        $path_array = array("view", "Exercice", "creer.php");

        $PATH = File::build_path($path_array);
        require "$PATH";
    }
    
    public static function created(){
        $idExercice = uniqid();
        $nomExercice = $_POST['nomExercice'];
        $difficulte = $_POST['difficulte'];
        $acces = $_POST['acces'];
        //$idMatiere = $_POST['idMatiere'];
        $tempsLimite = $_POST['tempsLimite'];
        $coeff = $_POST['coeff'];
        $ennonce = $_POST['ennonce'];
        
        if ($_FILES['correction']['error'] > 0) $erreur = "Erreur lors du transfert de la correction";
        $maxsize = $_POST['MAX_FILE_SIZE'];
        if ($_FILES['correction']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
        
        $extensions_valides = array( 'pdf' , 'docx');
        //strrchr renvoie l'extension avec le point (« . »).
        //substr(chaine,1) ignore le premier caractère de chaine.
        //strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['correction']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
        
        $name = File::build_path(array('lib',"corrections/{$idExercice}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
        $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
        
        $e = new ModelExerciceClassique($nomExercice, $difficulte, $acces, $idMatiere, $tempsLimite, $coeff,$ennonce);
        $e::save();
    }
    
    public static function afficherCorrection():void
    {
        // TODO: implement here
    }
    
    public static function obtenirAide():void
    {
        // TODO: implement here
    }
    
    
}