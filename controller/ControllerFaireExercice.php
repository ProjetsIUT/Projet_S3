
<?php

require_once (File::build_path(array('model','ModelFaireExercice.php')));
require_once (File::build_path(array('model','ModelEtudiant.php')));

class ControllerFaireExercice{
    
    protected static $object = 'faireExercice';

    static function reponse(){
        
        $data = array('loginEtudiant' => $_SESSION['loginUtilisateur'], 'idExercice' => $_POST['idExercice'], "reponse" => $_POST['reponse']);

        $obj = new ModelFaireExercice($_SESSION['loginUtilisateur'], $_POST['idExercice'], $_POST['reponse']);

        $obj->save($data);

        $view = "fait";
        $pagetitle = "Exercice Fait";
        require (File::build_path(array('view', 'view.php')));

    }

    static function correction(){

    	$id = $_GET['id'];
    	$loginEtudiant = $_GET['loginEtudiant'];
        
        $ex = ModelExerciceClassique::select($id);
        $etu = ModelEtudiant
        $rep = ModelFaireExercice($id, $loginEtudiant);

        $nomE = $e->get('nomExercice');
        $enonce = $e->get('enonce');

        $reponse

    	$view = "correction";
    	$pagetitle = "Agora - Correction";
    	require (File::build_path(array('view', 'view.php')));

    }


}




