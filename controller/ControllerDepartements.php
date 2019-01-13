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
			$m = ModelDepartements::select($_GET['codeDepartement']);
            if($m) {
                if (Session::is_admin()) {
                    $mcodeDepartement = $m->get('codeDepartement');
					$mnomDepartement = $m->get('nomDepartement');
					$e = ModelEtablissements::select($m->get('codeEtablissement'));
					$mnomEtablissement = $e->get('nomEtablissement');
					$view = 'detail';
                    $pagetitle = 'Details du département '.$mnomDepartement;
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
                $error_code = 'read : codeDepartement inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'read : codeDepartement vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function delete() {
        if(isset($_GET['codeDepartement'])) {
            if (Session::is_admin()) {
				$d = ModelDepartements::select($_GET['codeDepartement']);
				if($d) {
					ModelDepartements::delete($_GET['codeDepartement']);
					$view = 'deleted';
					$pagetitle = 'Suppression d\'un departement';
					require (File::build_path(array('view', 'view.php')));
				}
				else {
                    $error_code = 'delete : codeDepartement inexistant';
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
            $error_code = 'delete : codeDepartement vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function create() {
		if (Session::is_admin()) {
			$tab_e = ModelEtablissements::selectAll();
			$type = 'Ajout d\'un département';
			$view = 'create';
			$pagetitle = 'Ajout d\'un département - Agora';
			require (File::build_path(array('view', 'view.php')));
		}
		else {
            $error_code = 'Impossible de créer une matière';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function created() {
        if(isset($_GET['nomDepartement']) && isset($_GET['codeEtablissement'])) {
				$data = array(
					//"codeDepartement" => $_GET['codeDepartement'],
					"nomDepartement" => $_GET['nomDepartement'],
					"codeEtablissement" => $_GET['codeEtablissement'],
				);
				$n = new ModelDepartements();
				$n->save($data);
				$view = 'created';
				$pagetitle = 'Departement crée - Agora';
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
        if (isset($_GET['codeDepartement'])) {
            $d = ModelDepartements::select($_GET['codeDepartement']);
            if($d) {
                if (Session::is_admin()) {
                        $tab_e = ModelEtablissements::selectAll();
						$mcodeDepartement = $d->get('codeDepartement');
                        $mnomDepartement = $d->get('nomDepartement');
						$mcodeEtablissement = $d->get('codeEtablissement');
                        $type = "Modification des informations du département $mcodeDepartement";
                        $view = 'update';
                        $pagetitle = "Mes informations du département $mcodeDepartement";
                        require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'update : vous n\'avez pas accès à ces données';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                } 
            }
            else {
                $error_code = 'update : département inexistante';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'update : codeDepartement vide';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function updated() {
        if(isset($_GET['codeDepartement']) && isset($_GET['nomDepartement']) && isset($_GET['codeEtablissement'])) {
            $d = ModelDepartements::select($_GET['codeDepartement']);
            if($d) {
                if(Session::is_admin()) {
                    $data = array(
						"codeDepartement" => $_GET['codeDepartement'],
						"nomDepartement" => $_GET['nomDepartement'],
						"codeEtablissement" => $_GET['codeEtablissement'],
					);
					$n = new ModelDepartements();
					$n->update($data);
					$view = 'updated';
					$pagetitle = 'Département modifié - Agora';
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
                $error_code = 'updated : ce codeDepartement est inexistant';
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