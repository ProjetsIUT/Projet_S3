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

	protected static $object = 'etudiants';


	public static function nbEtudiants(){  //retourne le nombre d'étudiants ayant une moyenne

		$tab_logins=ModelNotes::classementPromo();
		return count($tab_logins);

	}

	public static function getRang(){

		$tab_logins=ModelNotes::classementPromo();
		$rang=1;

		for($i=0;$i<count($tab_logins);$i++){

			if($tab_logins[$i][0]===$_SESSION['loginUtilisateur']){

				return $rang;
			}

			$rang++;

		}

		return -1;


	}
	

     public static function show_perso_page(){

     	if(isset($_SESSION['loginUtilisateur'])){

			$e = ModelEtudiants::select($_SESSION['loginUtilisateur']);
			$_SESSION['anneeCourantEtudiant'] = $e->get('anneeCourantEtudiant');
			$_SESSION['SemestreCourantEtudiant'] = $e->get('SemestreCourantEtudiant');
			$_SESSION['codeDepartement'] = $e->get('codeDepartement');


 			$tab_notes=ModelNotes::selectByEtud();
 			$tab_cours=ModelCours::getAllByEtud();

 			$moyenneGenerale=ModelNotes::moyenneGenerale();
 			ControllerNotes::setGraphsEtudiant();
 			$monClassement = self::getRang();
 			$taillePromo=self::nbEtudiants();


	        $view='pageperso';
	        $page_id="page_perso_etudiants";
	        $pagetitle="Agora - La nouvelle façon d'apprendre";
	        require (File::build_path(array('view', 'view.php')));

    	}else{
    		header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
    	}
	}
	
	public static function create_info_etud() {
		$view = 'create_info_etud';
		$pagetitle = 'Ajout d\'un utilisateur - 2/2 - Agora';
		require (File::build_path(array('view', 'view.php')));
	}




}


?>