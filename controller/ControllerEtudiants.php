<?php

$path=array('model','ModelEtudiants.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);

$path=array('controller','ControllerUtilisateurs.php');
require_once File::build_path($path);

class ControllerEtudiants extends ControllerUtilisateurs{

	protected static $object= 'etudiants';

    public static function show_perso_page(){

		$e = ModelEtudiants::select($_SESSION['loginUtilisateur']);
		$_SESSION['anneeCourantEtudiant'] = $e->get('anneeCourantEtudiant');
		$_SESSION['SemestreCourantEtudiant'] = $e->get('SemestreCourantEtudiant');
		$_SESSION['codeDepartement'] = $e->get('codeDepartement');
        $view='pageperso';
        $page_id="page_perso_etudiants";
        $pagetitle="Agora - La nouvelle façon d'apprendre";
        require (File::build_path(array('view', 'view.php')));

    }


/*	public static function connect() {

		$login=$_GET["login"];
		$password=$_GET["password"];

		//$array=array("loginEtudiant"=>$login , "mdpEtudiant"=>$password);
		$etudiant_fictif =new ModelEtudiants();
		$etudiant_fictif->set("loginEtudiant",$login);
		$etudiant_fictif->set("mdpEtudiant",$password);

		$connect_state=$etudiant_fictif->connect();

		if($connect_state==1){ //succès: l'étudiant est connecté

			$view='pageperso';
			$pagetitle="Agora - La nouvelle façon d'apprendre";
			$page_id="page_perso";
			require (File::build_path(array('view', 'view.php')));

		}else if($connect_state==0){ //échec: mauvais mdp

			$view='login';
			$pagetitle="Connexion - Agora";
			$code_connect_failed='error_mdp';
			require (File::build_path(array('view', 'view.php')));

		}else{ //échec: étudiant non inscrit

			$view='login';
			$pagetitle="Connexion - Agora";
			$code_connect_failed='error_user';
			require (File::build_path(array('view', 'view.php')));
		}

	}*/

	


}


?>