
<?php

require_once (File::build_path(array('model','ModelFaireExercice.php')));

class ControllerFaireExercice{
    
    protected static $object = 'faireExercice';

    static function reponse(){
        $data = array('loginEtudiant' => 'chaptala', 'idExercice' => $_POST['idExercice'], "reponse" => $_POST['reponse']);

        $obj = new ModelFaireExercice('chaptala', $_POST['idExercice'], $_POST['reponse']);

        $obj->save($data);

        $view = "fait";
        $pagetitle = "Exercice Fait";
        require (File::build_path(array('view', 'view.php')));

    }

}




