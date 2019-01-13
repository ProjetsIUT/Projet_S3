<?php
require_once File::build_path(array('model', 'ModelEtablissements.php'));
 
$path=array('model','ModelDepartements.php');
require_once File::build_path($path);

require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerDepartements extends Controller{

	protected static $object = "departements";
	
	public static function readAll() {
		if(Session::is_admin()) {
			$view = 'list';
			$pagetitle = 'Liste des departements';
			$tab_d = ModelDepartements::selectAll();
			require (File::build_path(array('view', 'view.php')));
		}
		else {
			$pagetitle = 'Erreur';
			$error_code = 'readAll : vous ne disposez pas des droits necessaires pour accéder à cette liste';
			require (File::build_path(array('view', 'error.php')));
		}
	}

	public static function read() {
        if(isset($_GET['codeDepartement'])) {
			$m = ModelMatieres::select($_GET['codeDepartement']);
            if($m) {
                if (Session::is_admin()) {
                    $mcodematiere = $m->get('codeMatiere');
					$mnommatiere = $m->get('nomMatiere');
					$d = ModelDepartements::select($m->get('codeDepartement'));
					$mnomDepartement = $d->get('nomDepartement');
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

	public static function delete() {
        if(isset($_GET['codeMatiere'])) {
            if (Session::is_admin()) {
				$e = ModelMatieres::select($_GET['codeMatiere']);
				if($e) {
					ModelMatieres::delete($_GET['codeMatiere']);
					$view = 'deleted';
					$pagetitle = 'Suppression d\'une matiere';
					require (File::build_path(array('view', 'view.php')));
				}
				else {
                    $error_code = 'delete : codeMatiere inexistant';
                    $view = 'error';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                }
            } 
            else {
                $error_code = 'delete : Vous ne pouvez pas effectuer cette action';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            } 
        }
        else {
            $error_code = 'delete : codeMatiere vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function create() {
		if (Session::is_admin()) {
			$tab_d = ModelDepartements::selectAll();
			$type = 'Ajout d\'une matière';
			$view = 'create';
			$pagetitle = 'Ajout d\'une matière - Agora';
			require (File::build_path(array('view', 'view.php')));
		}
		else {
            $error_code = 'Impossible de créer une matière';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function created() {
        if(isset($_GET['nomMatiere']) && isset($_GET['codeDepartement'])) {
				$data = array(
					//"codeMatiere" => $_GET['codeMatiere'],
					"nomMatiere" => $_GET['nomMatiere'],
					"codeDepartement" => $_GET['codeDepartement'],
				);
				$n = new ModelMatieres();
				$n->save($data);
				$view = 'created';
				$pagetitle = 'Matiere crée - Agora';
				require (File::build_path(array('view', 'view.php')));                      
        }
        else {
            $error_code = 'created : l\'un des champs est vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}
	
	public static function update() {
        if (isset($_GET['codeMatiere'])) {
            $m = ModelMatieres::select($_GET['codeMatiere']);
            if($m) {
                if (Session::is_admin()) {
						$mcodematiere = $m->get('codeMatiere');
						$mnommatiere = $m->get('nomMatiere');
						$mcodeDepartement = $m->get('codeDepartement');
                        $type = "Modification des informations de la matiere $mcodematiere";
                        $view = 'update';
                        $pagetitle = "Mes informations de la matière $mcodematiere";
                        require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'update : vous n\'avez pas accès à ces données';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                } 
            }
            else {
                $error_code = 'update : matiere inexistante';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'update : codeMatiere vide';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function updated() {
        if(isset($_GET['codeMatiere']) && isset($_GET['nomMatiere']) && isset($_GET['codeDepartement'])) {
            $m = ModelMatieres::select($_GET['codeMatiere']);
            if($m) {
                if(Session::is_admin()) {
                    $data = array(
						"codeMatiere" => $_GET['codeMatiere'],
						"nomMatiere" => $_GET['nomMatiere'],
						"codeDepartement" => $_GET['codedepartement'],
					);
					$n = new ModelMatieres();
					$n->update($data);
					$view = 'updated';
					$pagetitle = 'Matiere modifié - Agora';
					require (File::build_path(array('view', 'view.php')));                    
				}
                else {
                    $error_code = 'updated : Vous ne pouvez pas avoir accès à ces informations';
                    $view = 'error';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                }
            }
            else {
                $error_code = 'updated : ce codeMatiere est inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }

        }
        else {
            $error_code = 'updated : l\'un des champs est vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }


}

?>