
<?php

require_once (File::build_path(array('model','ModelFaireExercice.php')));

class ControllerFaireExercice{
    
    

    static function reponse(){
        $data = array('loginEtudiant' => $_SESSION['loginEtudiant'], 'idExercice' => $id, "reponse" => $_POST['reponse']);

    }

}




