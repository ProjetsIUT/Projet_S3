
<?php

$path=array('model','ModelEnseignants.php');
require_once File::build_path($path);

$path=array('model','ModelCours.php');
require_once File::build_path($path);

$path=array('model','ModelFaireExercice.php');
require_once File::build_path($path);

$path=array('model','ModelExerciceClassique.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);

$path=array('controller','ControllerUtilisateurs.php');
require_once File::build_path($path);

$path=array('controller','ControllerNotes.php');
require_once File::build_path($path);



class ControllerEnseignants extends ControllerUtilisateurs{

	protected static $object= 'enseignants';

    
     public static function show_perso_page(){
        if(Session::is_teacher()) {
            $tab_cours=ModelCours::getAllByEnseignant();

            $tab_exs=ModelFaireExercice::getAllByEnseignant();

            ControllerNotes::setGraphsEnseignant();

            $view='pageperso';
            $page_id="page_perso_enseignants";
            $pagetitle="Agora - La nouvelle façon d'apprendre";
            require (File::build_path(array('view', 'view.php')));
        }else{
            $error_code = 'Accès à cette page interdit pour votre compte';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }

    }

}
 
?>