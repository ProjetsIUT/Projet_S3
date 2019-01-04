<?php

$path=array('model','ModelEtudiants.php');
require_once File::build_path($path);

$path=array('model','ModelNotes.php');
require_once File::build_path($path);

$path=array('model','ModelQCM.php');
require_once File::build_path($path);

$path=array('model','ModelExerciceClassique.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);

$path=array('controller','ControllerUtilisateurs.php');
require_once File::build_path($path);

$path=array('controller','ControllerNotes.php');
require_once File::build_path($path);

class ControllerEtudiants extends ControllerUtilisateurs{

	protected static $object= 'etudiants';


	

     public static function show_perso_page(){

     	if(isset($_SESSION['loginUtilisateur'])){

			$e = ModelEtudiants::select($_SESSION['loginUtilisateur']);
			$_SESSION['anneeCourantEtudiant'] = $e->get('anneeCourantEtudiant');
			$_SESSION['SemestreCourantEtudiant'] = $e->get('SemestreCourantEtudiant');
			$_SESSION['codeDepartement'] = $e->get('codeDepartement');


 			$tab_notes=ModelNotes::selectByEtud();
 			$moyenneGenerale=ModelNotes::moyenneGenerale();
 			//$monClassement = self::getRang();


	        $view='pageperso';
	        $page_id="page_perso_etudiants";
	        $pagetitle="Agora - La nouvelle façon d'apprendre";
	        require (File::build_path(array('view', 'view.php')));

    	}else{

    		header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');



    	}


    }




}


?>