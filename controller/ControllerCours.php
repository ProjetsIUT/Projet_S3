
<?php

require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelMatieres.php')));

require_once (File::build_path(array('lib','Session.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 

class ControllerCours extends Controller{


	protected static $object = 'cours';

	public static function show_form_new(){

		$tab_matieres = ModelMatieres::getAllbyEnseignant();

		$tab_nom_matieres=array();
		$tab_code_matieres=array();

		foreach ($tab_matieres as $code) {
			
			$matiere=ModelMatieres::select($code);
			array_push($tab_nom_matieres,$matiere->get("nomMatiere"));
			array_push($tab_code_matieres,$matiere->get("codeMatiere"));

		}

		$view="ajouterCours";
		$pagetitle="Ajouter un nouveau cours - Agora";
		require (File::build_path(array('view', 'view.php')));
		
	}

	public static function list(){

		if(!isset($_SESSION['loginUtilisateur'])){

			header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
		}

		if(Session::is_student()){

			$tab = ModelCours::getAllByEtud();
	

		}else{

			$tab=ModelCours::getAllByEnseignant(); 

		}

		$path=array('model','ModelMatieres.php');
		require_once File::build_path($path);
		$view="list";
		$pagetitle="Tous mes cours - Agora";
		require(File::build_path(array('view','view.php')));



	}


	public static function upload_cours(){

		$codeCours = uniqid();
		$chemin_fichier_cours=ModelCours::upload($codeCours);
		$date=date("Y-m-d");
		$data=array("codeCours"=>$codeCours,"nomCours"=>$_POST['nomCours'],"datePublication"=>$date ,"codeMatiere"=>$_POST['code'],"accesCours"=>$_POST['accesCours'],"fichierCours"=>$chemin_fichier_cours, "resumeCours"=>$_POST['resume']);
		$cours=new ModelCours($data);
		$cours->save($data);

		$tab = ModelCours::selectAll();
		$path=array('model','ModelMatieres.php');
		require_once File::build_path($path);
		$view="list";
		$pagetitle="Tous mes cours - Agora";
		require(File::build_path(array('view','view.php')));

		
	}


	public static function suppr(){

		$codeCours = $_GET["code"];
		ModelCours::delete($codeCours);
		self::list();


	}




}


?>