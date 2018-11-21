<?php

$path=array('model','ModelEtudiants.php');
	require_once File::build_path($path);

class ControllerEtudiants{

	protected static $object= 'etudiants';


	public static function connect() {

		$login=$_GET["login"];
		$password=$_GET["password"];

		//$array=array("loginEtudiant"=>$login , "mdpEtudiant"=>$password);
		$etudiant_fictif =new ModelEtudiants();
		$etudiant_fictif->set("loginEtudiant",$login);
		$etudiant_fictif->set("mdpEtudiant",$password);

		$connect_state=$etudiant_fictif->connect();

		if($connect_state==1){ //succès: l'étudiant est connecté

			$view='pageperso';
			$pagetitle="Bienvenue sur votre espace personnel - Agora";
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

	}

	  public static function readAll() {
        $tab_u = ModelUtilisateur::selectAll();
        $controller = 'utilisateur';
        $view = 'list';
        $pagetitle = 'Liste des utilisateurs';
        require (File::build_path(array('view', 'view.php')));
    }

    public static function read() {
        if(isset($_GET['login'])) {
            $u = ModelUtilisateur::select($_GET['login']);

            if($u) {
                $controller = 'utilisateur';
                $view = 'detail';
                $pagetitle = 'Details des utilisateurs';
                require (File::build_path(array('view', 'view.php')));
            }
            else {
                $controller = 'utilisateur';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $controller = 'utilisateur';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }
    
    public static function delete() {

        if(isset($_GET['login'])) {
            if(ModelUtilisateur::select($_GET['login'])) {
                $u = ModelUtilisateur::delete($_GET['login']);
                $controller = 'utilisateur';
                $view = 'deleted';
                $pagetitle = 'Suppression d\'un utilisateur';
                $tab_u = ModelUtilisateur::selectAll();
                require (File::build_path(array('view', 'view.php')));
            }
            else {
                $controller = 'utilisateur';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $controller = 'utilisateur';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function create() {
        $controller = 'utilisateur';
        $view = 'update';
        $pagetitle = 'Creation d\'utilisateur';
        require (File::build_path(array('view', 'view.php')));
    }

    public static function created() {
         if(isset($_GET['loginEtudiant']) && isset($_GET['nomEtudiant']) && isset($_GET['prenomEtudiant']) && isset($_GET['mdpEtudiant']) && isset($_GET['emailEtudiant']) && isset($_GET['anneCourantEtudiant']) && isset($_GET['SemestreCourantEtudiant'])) {
            //$controller = 'utilisateur';
            $view = 'created';
            $pagetitle = 'Utilisateur créé';
            $data = array(
                "login" => $_GET['login'],
                "nom" => $_GET['nom'],
                "prenom" => $_GET['prenom'],
            );
            $u = new ModelUtilisateur($_GET['login'], $_GET['nom'], $_GET['prenom']);
            $u->save($data);
            $tab_u = ModelUtilisateur::selectAll();
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $controller = '';
            $view = 'error';
            $pagetitle = 'Erreur - Agora';
            require (File::build_path(array('view', 'view.php')));
       }
    }

    public static function update() {
        if (isset($_GET['login'])) {
            $u = ModelUtilisateur::select($_GET['login']);
            $nom = $u->get('nom');
            $prenom = $u->get('prenom');
            $controller = 'utilisateur';
            $view = 'update';
            $pagetitle = 'Utilisateur à modifier';
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $controller = 'utilisateur';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function updated() {
        if(isset($_GET['login']) && isset($_GET['nom']) && isset($_GET['prenom'])) {
            //$controller = 'voiture';
            $view = 'updated';
            $pagetitle = 'Utilisateur modifié';
            $login = $_GET['login'];
            $data = array(
                "login" => $_GET['login'],
                "nom" => $_GET['nom'],
                "prenom" => $_GET['prenom'],
            );
            $u = new ModelUtilisateur($_GET['login'], $_GET['nom'], $_GET['prenom']);
            $u->update($data);
            $tab_u = ModelUtilisateur::selectAll();
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $controller = 'voiture';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }






}


?>