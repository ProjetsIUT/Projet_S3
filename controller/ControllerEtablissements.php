<?php
;
 
$path=array('model','ModelEtablissements.php');
require_once File::build_path($path);

require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerEtablissements extends Controller{

	protected static $object = "etablissements";
	
	public static function readAll() {
		if(Session::is_admin()) {
			$view = 'list';
			$pagetitle = 'Liste des établissements';
			$tab_e = ModelEtablissements::selectAll();
			require (File::build_path(array('view', 'view.php')));
		}
		else {
			$pagetitle = 'Erreur';
			$error_code = 'readAll : vous ne disposez pas des droits necessaires pour accéder à cette liste';
			require (File::build_path(array('view', 'error.php')));
		}
	}

	public static function read() {
        if(isset($_GET['codeEtablissement'])) {
			$m = ModelEtablissements::select($_GET['codeEtablissement']);
            if($m) {
                if (Session::is_admin()) {
                    $mcodeEtablissement = $m->get('codeEtablissement');
					$mnomEtablissement = $m->get('nomEtablissement');
					$mvilleEtablissement = $m->get('villeEtablissement');
					$view = 'detail';
                    $pagetitle = 'Details de la matière '.$mnomEtablissement;
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
                $error_code = 'read : codeEtablissement inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'read : codeEtablissement vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function delete() {
        if(isset($_GET['codeEtablissement'])) {
            if (Session::is_admin()) {
				$e = ModelEtablissements::select($_GET['codeEtablissement']);
				if($e) {
					ModelEtablissements::delete($_GET['codeEtablissement']);
					$view = 'deleted';
					$pagetitle = 'Suppression d\'un établissement';
					require (File::build_path(array('view', 'view.php')));
				}
				else {
                    $error_code = 'delete : codeEtablissement inexistant';
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
            $error_code = 'delete : codeEtablissement vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function create() {
		if (Session::is_admin()) {
			$type = 'Ajout d\'un établissement';
			$view = 'create';
			$pagetitle = 'Ajout d\'un établissement - Agora';
			require (File::build_path(array('view', 'view.php')));
		}
		else {
            $error_code = 'Impossible de créer un établissement';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function created() {
        if(Session::is_admin()) {
            if(isset($_GET['nomEtablissement']) && isset($_GET['villeEtablissement'])) {
                    $data = array(
                        //"codeEtablissement" => $_GET['codeEtablissement'],
                        "nomEtablissement" => $_GET['nomEtablissement'],
                        "villeEtablissement" => $_GET['villeEtablissement'],
                    );
                    $n = new ModelEtablissements();
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
        else {
            $error_code = 'Vous ne disposez des droits suffisant';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}
	
	public static function update() {
        if (isset($_GET['codeEtablissement'])) {
            $m = ModelEtablissements::select($_GET['codeEtablissement']);
            if($m) {
                if (Session::is_admin()) {
						$mcodeEtablissement = $m->get('codeEtablissement');
						$mnomEtablissement = $m->get('nomEtablissement');
						$mvilleEtablissement = $m->get('villeEtablissement');
                        $type = "Modification des informations de l'établissement : $mnomEtablissement";
                        $view = 'update';
                        $pagetitle = "Mes informations de l'etablissement $mcodeEtablissement";
                        require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'update : vous n\'avez pas accès à ces données';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                } 
            }
            else {
                $error_code = 'update : etablissement inexistant';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'update : codeEtablissement vide';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function updated() {
        if(isset($_GET['codeEtablissement']) && isset($_GET['nomEtablissement']) && isset($_GET['villeEtablissement'])) {
            $m = ModelEtablissements::select($_GET['codeEtablissement']);
            if($m) {
                if(Session::is_admin()) {
                    $data = array(
						"codeEtablissement" => $_GET['codeEtablissement'],
						"nomEtablissement" => $_GET['nomEtablissement'],
						"villeEtablissement" => $_GET['villeEtablissement'],
					);
					$n = new ModelEtablissements();
					$n->update($data);
					$view = 'updated';
					$pagetitle = 'Etablissement modifié - Agora';
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
                $error_code = 'updated : ce codeEtablissement est inexistant';
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