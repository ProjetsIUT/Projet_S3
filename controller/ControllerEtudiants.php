
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
			if(empty($tab_notes)) {
				$verif = "Il n'y a aucune note";
			}
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
		if (Session::is_admin()) {
			$type = 'Ajout d\'un étudiant';
			$view = 'create_info_etud';
			$pagetitle = 'Ajout d\'un utilisateur - 2/2 - Agora';
			require (File::build_path(array('view', 'view.php')));
		}
		else {
            $error_code = 'Impossible de créer un compte universitaire étudiant. Contactez l\'administrateur de votre université pour tout renseignement';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}

	public static function created_info_etud() {
        if(isset($_GET['loginEtudiant']) && isset($_GET['anneencours']) && isset($_GET['codedepartement']) && isset($_GET['semestreencours'])) {
            $u = ModelEtudiants::select($_GET['loginEtudiant']);
            if($u == false) {
				$data = array(
					"loginEtudiant" => $_GET['loginEtudiant'],
					"anneeCourantEtudiant" => $_GET['anneencours'],
					"SemestreCourantEtudiant" => $_GET['semestreencours'],
					"codeDepartement" => $_GET['codedepartement'],
				);
				$e = new ModelEtudiants();
				$e->saveEtud($data);
				$view = 'created_info_etud';
				$pagetitle = 'Compte crée - Agora';
				require (File::build_path(array('view', 'view.php')));                    
			}
			else {
                $type = 'Ajout';
                $verif = 'Ce nom d\'étudiant existe déja';
                $view = 'update';
                $pagetitle = 'Ajout d\'un utilisateur - 2/2 - Agora';
                require (File::build_path(array('view', 'view.php')));                    
            }  
        }
        else {
            $error_code = 'created_info_etud : l\'un des champs est vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

	public static function readAll() {
		$view = 'list';
		$pagetitle = 'Liste étudiante';
		$tab_u = ModelEtudiants::selectAll();
		require (File::build_path(array('view', 'view.php')));
	}

	public static function read() {
        if(isset($_GET['loginEtudiant'])) {
			$u = ModelEtudiants::select($_GET['loginEtudiant']);
			$ut = ModelUtilisateurs::select($_GET['loginEtudiant']);
            if($u) {
                if (Session::is_user($_GET['loginEtudiant']) || Session::is_admin()) {
                    $umoyenneGenerale = ModelNotes::moyenneGenerale($_GET['loginEtudiant']);
					$ulogin = $u->get('loginEtudiant');
					$unom = $ut->get('nomUtilisateur');
					$uprenom = $ut->get('prenomUtilisateur');
					$uace = $u->get('anneeCourantEtudiant');
                    $ucd = $u->get('codeDepartement');
                    $usce = $u->get('SemestreCourantEtudiant');
					$view = 'detail';
					if(Session::is_user($_GET['loginEtudiant'])) {
                        $pagetitle = 'Mes informations utilisateur';
                    }
                    $pagetitle = 'Details de l\'étudiant '.$ulogin;
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
                $error_code = 'read : loginEtudiant inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'read : loginEtudiant vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}
	
	public static function delete() {
        if(isset($_GET['loginEtudiant'])) {
            if (Session::is_user($_GET['loginEtudiant']) || Session::is_admin()) {
				$e = ModelEtudiants::select($_GET['loginEtudiant']);
				if($e) {
					ModelEtudiants::delete($_GET['loginEtudiant']);
					$view = 'deleted';
					$pagetitle = 'Suppression d\'un utilisateur';
					if(Session::is_user($_GET['loginUtilisateur'])) {
						self::deconnect();
					}
					require (File::build_path(array('view', 'view.php')));
				}
				else {
                    $error_code = 'delete : loginUtilisateur inexistant';
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
            $error_code = 'delete : loginUtilisateur vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
	}
	


}




?>