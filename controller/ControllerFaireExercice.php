
<?php

require_once (File::build_path(array('model','ModelFaireExercice.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerFaireExercice extends Controller{
    
    

    static function reponse(){
        $data = array('loginEtudiant' => $_SESSION['loginEtudiant'], 'idExercice' => $id, "reponse" => $_POST['reponse']);

    }

}




