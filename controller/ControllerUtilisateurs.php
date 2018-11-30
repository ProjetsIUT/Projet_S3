<?php

require_once (File::build_path(array('model', 'ModelUtilisateurs.php'))); 

require_once (File::build_path(array('lib', 'Security.php')));

class ControllerUtilisateurs{

	protected static $object= 'utilisateurs';

    public static function show_password_page(){

        $view='definirMdp';
        $pagetitle="Première connexion - Agora";
        require (File::build_path(array('view', 'view.php')));


    }

    public static function update_password(){

        $mdp_en_clair=$_POST["new_password"];
        $mdp_crypte=Security::chiffrer($mdp_en_clair);

        $e = new ModelUtilisateurs();
        $e->set('loginUtilisateur',$_POST["login"]);

        $data=array("loginUtilisateur"=>$_POST["login"],"mdpUtilisateur"=>$mdp_crypte);
        $e->update($data);

        $redirection = (File::build_path(array('?controller=utilisateurs&action=show_login_page')));

        header('Location: '.$redirection);
        exit();


    }


	public static function show_login_page(){

		$view='login';
		$pagetitle="Connexion - Agora";
		require (File::build_path(array('view', 'view.php')));

	}	


    public static function connect() {

        $login=$_GET["login"];
        $password=$_GET["password"];

        //$array=array("loginEtudiant"=>$login , "mdpEtudiant"=>$password);
        $utilisateur_fictif =new ModelUtilisateurs();
        $utilisateur_fictif->set("loginUtilisateur",$login);
        $utilisateur_fictif->set("mdpUtilisateur",$password);

        $connect_state=$utilisateur_fictif->connect();

        if($connect_state==1){ //succès: l'utilisateur est connecté

            if($_SESSION["typeCompte"]==="etudiant"){ //si c'est un étudiant 

             $redirection = (File::build_path(array('?controller=etudiants&action=show_perso_page')));

             header('Location: '.$redirection);
            
            }

            if($_SESSION["typeCompte"]==="enseignant"){ //si c'est un enseignant

             $redirection = (File::build_path(array('?controller=enseignants&action=show_perso_page')));

             header('Location: '.$redirection);
            
            }

            if($_SESSION["typeCompte"]==="admin"){ //si c'est un admin

             $redirection = (File::build_path(array('?controller=admins&action=show_perso_page')));

             header('Location: '.$redirection);
            
            }


        }else if($connect_state==0){ //échec: mauvais mdp

            $view='login';
            $pagetitle="Connexion - Agora";
            $code_connect_failed='error_mdp';
            require (File::build_path(array('view', 'view.php')));

        }else{ //échec: utilisateur non inscrit

            $view='login';
            $pagetitle="Connexion - Agora";
            $code_connect_failed='error_user';
            require (File::build_path(array('view', 'view.php')));
        }

    }


	  public static function readAll() {
        $tab_u = ModelUtilisateurs::selectAll();
        $controller = 'utilisateur';
        $view = 'list';
        $pagetitle = 'Liste des utilisateurs';
        require (File::build_path(array('view', 'view.php')));
    }

    public static function read() {
        if(isset($_GET['login'])) {
            $u = ModelUtilisateurs::select($_GET['login']);

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
                $u = ModelUtilisateurs::delete($_GET['login']);
                $controller = 'utilisateur';
                $view = 'deleted';
                $pagetitle = 'Suppression d\'un utilisateur';
                $tab_u = ModelUtilisateurs::selectAll();
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
        if(isset($_GET['login']) && isset($_GET['nom']) && isset($_GET['prenom'])) {
            //$controller = 'utilisateur';
            $view = 'created';
            $pagetitle = 'Utilisateur créé';
            $data = array(
                "login" => $_GET['login'],
                "nom" => $_GET['nom'],
                "prenom" => $_GET['prenom'],
            );
            $u = new ModelUtilisateurs($_GET['login'], $_GET['nom'], $_GET['prenom']);
            $u->save($data);
            $tab_u = ModelUtilisateurs::selectAll();
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
            $u = ModelUtilisateurs::select($_GET['login']);
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
            $u = new ModelUtilisateurs($_GET['login'], $_GET['nom'], $_GET['prenom']);
            $u->update($data);
            $tab_u = ModelUtilisateurs::selectAll();
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