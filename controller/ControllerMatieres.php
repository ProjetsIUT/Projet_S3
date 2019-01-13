
<?php

$path=array('model','ModelEnseignants.php');
require_once File::build_path($path);

$path=array('model','ModelDepartements.php');
require_once File::build_path($path);

$path=array('model','ModelEtablissements.php'); 
require_once File::build_path($path);

$path=array('model','ModelMatieres.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);
require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerMatieres extends Controller{

	protected static $object = "matieres";
	

	public static function ajoutAssociation(){

		if(Session::is_admin()){ 

			$tab_users=ModelUtilisateurs::selectAll();

			$tab_matieres = ModelMatieres::selectAll();


            $view = 'ajoutAssociations';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
		}
	}

	public static function addAssociation(){

		if(Session::is_admin()){

			$login = $_GET['user'];
			$codeMatiere = $_GET['matiere'];

			ModelMatieres::saveAssociation($login,$codeMatiere);

			header('Location: ./index.php?controller=administrateur&action=show_perso_page');



		}


	}
 

}

?>