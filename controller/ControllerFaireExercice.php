
<?php

require_once (File::build_path(array('model','ModelFaireExercice.php')));
require_once (File::build_path(array('model','ModelExerciceClassique.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 

class ControllerFaireExercice extends Controller{
    
    protected static $object = 'faireExercice';

    public static function reponse(){
        
        
        if(is_uploaded_file($_FILES['fichier']['tmp_name'])){
         //Traitement du fichier
        
            if ($_FILES['fichier']['error'] > 0) $error_code = "Erreur lors du transfert de la correction";
                $maxsize = 1048576;
            if ($_FILES['fichier']['size'] > $maxsize) $error_code = "Le fichier est trop gros";
        
                $extensions_valides = array( 'pdf' , 'zip');
                //strrchr renvoie l'extension avec le point (« . »).
                //substr(chaine,1) ignore le premier caractère de chaine.
                //strtolower met l'extension en minuscules.
                $extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
                if ( in_array($extension_upload,$extensions_valides) ){
                //$name = File::build_path(array('lib',"corrections/{$idExercice}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
                $name = "./data/".$_POST['idExercice'].$_SESSION['loginUtilisateur'].".".$extension_upload;
                $resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],$name);
            }else{
                $error_code = "extension incorecte";
            }

              
        }

        if (isset($error_code)){
                $view="error";
                $pagetitle="Erreur - Agora";
                require (File::build_path(array('view', 'view.php')));
            }else{

        if(!isset($name))$name = NULL;
        $data = array('loginEtudiant' => $_SESSION['loginUtilisateur'], 'idExercice' => $_POST['idExercice'], "reponse" => $_POST['reponse'], "date" => date("Y-m-d H:i:s"), "fichier" => $name);

        $obj = new ModelFaireExercice($_SESSION['loginUtilisateur'], $_POST['idExercice'], $_POST['reponse'], date("Y-m-d H:i:s"), NULL, $name);

        $obj->save($data);


        header('Location: ./index.php?controller=ExerciceClassique&action=list_en_attente');

       }
    }

    public static function correction(){
         if(!Session::is_teacher()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{
    	$id = $_GET['id'];
    	$loginEtudiant = $_GET['login'];

        
        $e = ModelExerciceClassique::select($id);
        $f = ModelFaireExercice::selectFaireExercice($id, $loginEtudiant);

        $nomE = $e->get('nomExercice');
        $enonce = $e->get('enonce');
        $reponse = $f->get('reponse');
        $fichier = $f->get('fichier');


    	$view = "correction";
    	$pagetitle = "Agora - Correction";
    	require (File::build_path(array('view', 'view.php')));

    }
    }


}





