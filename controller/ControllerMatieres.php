
<?php

 
$path=array('model','ModelMatieres.php');
require_once File::build_path($path);

require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerMatieres extends Controller{

	protected static $object = "matieres";
	
	public static function readAll() {
		if(Session::is_admin()) {
			$view = 'list';
			$pagetitle = 'Liste des matières';
			$tab_m = ModelMatieres::selectAll();
			require (File::build_path(array('view', 'view.php')));
		}
		else {
			$pagetitle = 'Erreur';
			$error_code = 'readAll : vous ne disposez pas des droits necessaires pour accéder à cette liste';
			require (File::build_path(array('view', 'error.php')));
		}
	}

	public static function read() {
        if(isset($_GET['codeMatiere'])) {
			$m = ModelMatieres::select($_GET['codeMatiere']);
            if($m) {
                if (Session::is_admin()) {
                    $mcodematiere = $m->get('codeMatiere');
					$mnommatiere = $m->get('nomMatiere');
					$mcodeDepartement = $m->get('codeDepartement');
					$view = 'detail';
                    $pagetitle = 'Details de la matière '.$mnommatiere;
                    require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'read : Vous ne pouvez pas avoir accès à des informations confidentiels sur d\'autre utilisateur';
                    $view = 'error';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                }
            }
            else {
                $error_code = 'read : codeMatiere inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'read : codeMatiere vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

}

?>