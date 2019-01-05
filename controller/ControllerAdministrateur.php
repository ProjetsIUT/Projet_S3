<?php

$path=array('model','ModelAdministrateur.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);

$path=array('controller','ControllerUtilisateurs.php');
require_once File::build_path($path);


class ControllerAdministrateur extends ControllerUtilisateurs{

	protected static $object= 'administrateur';

    
     public static function show_perso_page(){
        $view='pageperso';
        $page_id="page_perso_administrateur";
        $pagetitle="Agora - La nouvelle façon d'apprendre";
        require (File::build_path(array('view', 'view.php')));
    }



}


?>