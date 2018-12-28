<?php

require_once (File::build_path(array('model','ModelExerciceClassique.php')));

Class ControllerExerciceClassique {
    
    protected static $object = 'ExerciceClassique';
    
    public static function creerExercice()
    {
        $view="creer";

	    $pagetitle="Créer un nouvel exercice - Agora";

        $path_array = array("view", "view.php");

        $PATH = File::build_path($path_array);
        require "$PATH";
    }
    
    public static function created(){
        $idExercice = uniqid(); //String
        $nomExercice = $_POST['nomExercice'];
        $difficulte = $_POST['difficulte'];
        $acces = $_POST['acces'];
        //$idMatiere = $_POST['idMatiere'];
        $tempsLimite = $_POST['tempsLimite'];
        $coeff = $_POST['coeff'];
        $enonce = $_POST['enonce'];
        
        //Traitement du fichier de correction
        if ($_FILES['correction']['error'] > 0) $error_code = "Erreur lors du transfert de la correction";
        $maxsize = 1048576;
        if ($_FILES['correction']['size'] > $maxsize) $error_code = "Le fichier est trop gros";
        
        $extensions_valides = array( 'pdf' , 'docx');
        //strrchr renvoie l'extension avec le point (« . »).
        //substr(chaine,1) ignore le premier caractère de chaine.
        //strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['correction']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ){
            //$name = File::build_path(array('lib',"corrections/{$idExercice}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
            $name = "./lib/corrections/".$idExercice.".".$extension_upload;
            echo "chemin d'écriture : ".$name;
            $resultat = move_uploaded_file($_FILES['correction']['tmp_name'],$name);
        }else{
            $error_code = "extension incorecte";
        }
        
        if (isset($error_code)){
            $view="error";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'view.php')));
        }else{
            $data = array("idExercice" => $idExercice,"nomExercice" => $nomExercice, "difficulte" =>$difficulte, "acces" => $acces,"tempsLimite" => $tempsLimite, "coeff" => $coeff,"enonce" =>$enonce);
            $e = new ModelExerciceClassique($idExercice,$nomExercice, $difficulte, $acces, $tempsLimite, $coeff,$enonce);
            $e->save($data);
            
            $view = "created";
            $pagetitle = "Créé !!!";
            require (File::build_path(array('view', 'view.php')));
        }
        
    }

    public static function faireExercice(){
        $id = $_GET['id'];
        
        $e = ModelExerciceClassique::select($id);
              
        $nomE = $e['nomExercice'];
        $enonce = $e['enonce'];
        
        $view="faire";
	    $pagetitle="Faire exercice - Agora";
        $path_array = array("view", "view.php");

        $PATH = File::build_path($path_array);
        require "$PATH";
    }
    
}