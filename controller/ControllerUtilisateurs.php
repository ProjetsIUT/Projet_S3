<?php 
 
require_once (File::build_path(array('model', 'ModelUtilisateurs.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 
require_once (File::build_path(array('lib', 'Security.php')));
 
class ControllerUtilisateurs extends Controller{

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

        if(isset($_GET['login']) && isset($_GET['password'])){ //succès: l'utilisateur est connecté
            $login=$_GET['login'];
            $password=$_GET['password'];
            $mdpsecu = Security::chiffrer($password);
            $verif = ModelUtilisateurs::checkPassword($login, $mdpsecu); 
            if($verif) {
                $u = ModelUtilisateurs::select($login);
                $_SESSION['loginUtilisateur'] = $u->get('loginUtilisateur');
                $_SESSION['mdpUtilisateur'] = $u->get('mdpUtilisateur');
                $_SESSION['typeUtilisateur'] = $u->get('typeUtilisateur');
                $_SESSION['nomUtilisateur'] = $u->get('nomUtilisateur');
                $_SESSION['prenomUtilisateur'] = $u->get('prenomUtilisateur');
                $_SESSION['emailUtilisateur'] = $u->get('emailUtilisateur');
                $_SESSION['codeEtablissement'] = $u->get('codeUtilisateur');
                
                if($_SESSION["typeUtilisateur"]==="etudiant"){ //si c'est un étudiant 
                    $redirection = 'index.php?controller=etudiants&action=show_perso_page';
                    header('Location: '.$redirection);
                }

                if($_SESSION["typeUtilisateur"]==="enseignant"){ //si c'est un enseignant
                    $redirection = 'index.php?controller=enseignants&action=show_perso_page';
                    header('Location: '.$redirection);
                }

                if($_SESSION["typeUtilisateur"]==="admin"){ //si c'est un admin
                    $redirection = 'index.php?controller=admins&action=show_perso_page';
                    header('Location: '.$redirection);
                }
            
            }else { //échec: mauvais mdp
                $view='login';
                $pagetitle="Connexion - Agora";
                $code_connect_failed='error_mdp';
                require (File::build_path(array('view', 'view.php')));
            }
        }else{ //échec: utilisateur non inscrit
            $view='login';
            $pagetitle="Acceuil";
            $code_connect_failed='error_user';
            require (File::build_path(array('view', 'view.php')));
        }

    }

    public static function recuparemail() {
        $vemail = filter_var($_GET['email'] , FILTER_VALIDATE_EMAIL);
        $u = ModelUtilisateurs::getUserByEmail($_GET['email']);
        if($vemail) {
            var_dump($u);
            if($u) {
                $destinataire = $_GET['email'];
                $sujet = 'Récupération de mot de passe';
                $entete = 'From agoradmin@agora.fr';
                $mail = 'Bonjour '.htmlspecialchars($u->get('loginUtilisateur')).',
                
                Pour changer votre mot de passe, veuillez cliquer sur le lien-ci dessous ou 
                copier/coller dans votre navigateur internet :
                
                http://webinfo.iutmontp.univ-montp2.fr/~bourdesj/Projet_S3/index.php?controller=utilisateurs&action=changemdp&loginUtilisateur='.rawurlencode($u->get('loginUtilisateur')).'

                Ceci est un mail automatique, Merci de ne pas y répondre';
                mail($destinataire, $sujet, $mail, $entete);
                $view = 'mdp_oublie_recupere';
                $pagetitle= "Mail de récupération envoyé";
                require (File::build_path(array('view', 'view.php')));
            }
            else {
                $view = 'mdp_oublie';
                $pagetitle= "Mot de passe oublié";
                $code_connect_failed= 'error_email';
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $view = 'mdp_oublie';
            $pagetitle= "Mot de passe oublié";
            $code_connect_failed= 'error_not_email';
            require (File::build_path(array('view', 'view.php')));
        } 
    }

    public static function create() {
        if(Session::is_admin() || !isset($_SESSION['loginUtilisateur'])) {
            $type = 'Ajout';
            $view = 'update';
            $pagetitle = 'Ajout d\'un utilisateur';
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $error_code = 'create : vous ne pouvez pas créer un autre compte en étant connecté';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function validate() {
        $u = ModelUtilisateur::select($_GET['loginUtilisateur']);
        $nr = $_GET['nonce'];
        if ($u) {
            if ($nr === $u->get('nonce')) {
                $data = array(
                    "loginUtilisateur" => $_GET['loginUtilisateur'],
                    "nonce" => NULL,
                );
                ModelUtilisateur::update($data);
                $pagetitle = 'Validé';
                $view = 'validate';
                require (File::build_path(array('view', 'view.php')));
            }
            else if($u->get('nonce') == NULL){
                $error_code = 'validate : Votre compte a déja été validé';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
            else {
                $error_code = 'validate : Nous ne pouvons accéder à votre requête';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'validate : loginUtilisateur inexistant';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function changemdp() {
        $view = 'changemdp';
        $pagetitle= "Nouveau mot de passe";
        require (File::build_path(array('view', 'view.php')));
    }

    public static function changemdpfait() {
        
        if($_GET['mdp'] === $_GET['vmdp']) {
            $view = 'changemdpfait';
            $pagetitle = "Mot de passe changé";
            $mdpsecu = Security::chiffrer($_GET['mdp']);
            $u = new ModelUtilisateur();
            $data = array(
                "loginUtilisateur" => $_GET['loginUtilisateur'],
                "mdpUtilisateur" => $mdpsecu,
            );
            $u->update($data);
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $view = 'changemdp';
            $pagetitle = "Nouveau mot de passe";
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function created() {
        if(isset($_GET['loginUtilisateur']) && isset($_GET['nomUtilisateur']) && isset($_GET['prenomUtilisateur']) && isset($_GET['adresseFacturationUtilisateur']) && isset($_GET['adresseLivraisonUtilisateur']) && isset($_GET['passUtilisateur']) && isset($_GET['emailUser'])) {

            if($_GET['passUtilisateur'] === $_GET['vpassUtilisateur']) {
                $view = 'created';
                $pagetitle = 'Utilisateur ajouté';
                $mdpsecu = Security::chiffrer($_GET['passUtilisateur']);

                $vemail = filter_var($_GET['emailUser'] , FILTER_VALIDATE_EMAIL);
                
                if(Session::is_admin() && isset($_GET['typeUser'])) {
                    $valuet = $_GET['typeUser'];
                }
                else {
                    $valuet = NULL;
                } 

                if ($vemail) {
                    $nonc = Security::generateRandomHex();
                    $data = array(
                        "loginUtilisateur" => $_GET['loginUtilisateur'],
                        "nomUtilisateur" => $_GET['nomUtilisateur'],
                        "prenomUtilisateur" => $_GET['prenomUtilisateur'],
                        "adresseFacturationUtilisateur" => $_GET['adresseFacturationUtilisateur'],
                        "adresseLivraisonUtilisateur" => $_GET['adresseLivraisonUtilisateur'],
                        "passUtilisateur" => $mdpsecu,
                        "emailUser" => $_GET['emailUser'],
                        "typeUser" => $valuet,
                        "nonce" => $nonc,
                    );
                    $u = new ModelUtilisateur($data);
                    $u->save($data);
                        $destinataire = $_GET['emailUser'];
                        $sujet = 'Activer votre compte';
                        $entete = 'From serviceclient@pineapple.com';
                        $mail = 'Bienvenue sur PineApple,
                        
                        Pour activer votre compte, veuillez cliquer sur le lien-ci dessous ou 
                        copier/coller dans votre navigateur internet

                        http://webinfo.iutmontp.univ-montp2.fr/~bourdesj/eCommerce/index.php?controller=utilisateur&action=validate&loginUtilisateur='.rawurlencode($_GET['loginUtilisateur']).'&nonce='.rawurlencode($nonc).'


                        Ceci est un mail automatique, Merci de ne pas y répondre';
                        mail($destinataire, $sujet, $mail, $entete);
                        require (File::build_path(array('view', 'view.php')));
                } else {
                    $type = 'Ajout';
                    $verif = 'Votre email n\'est pas valide !';
                    $view = 'update';
                    $pagetitle = 'Ajout d\'un utilisateur';
                    require (File::build_path(array('view', 'view.php')));
                }
                
            } else {
                $type = 'Ajout';
                $verif = 'Vos deux mots de passe ne sont pas identiques !';
                $view = 'update';
                $pagetitle = 'Ajout d\'un utilisateur';
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $error_code = 'created : l\'un des champs est vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function deconnected() {
        session_unset(); 
        session_destroy();
        $redirection = 'index.php?controller=Utilisateurs&action=show_login_page';
        header('Location: '.$redirection);
    }

	public static function readAll() {
        if(Session::is_admin()) {
            $tab_u = ModelUtilisateurs::selectAll();
            $controller = 'utilisateur';
            $view = 'list';
            $pagetitle = 'Liste des utilisateurs';
            require (File::build_path(array('view', 'view.php')));
        }
        $view = 'list';
        $pagetitle = 'Liste des utilisateurs';
        $code_connect_failed = 'Vous n\'avez pas acceder à ces informations !';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read() {
        if(isset($_GET['login'])) {
            $u = ModelUtilisateurs::select($_GET['login']);
            if($u) {
                $view = 'detail';
                $pagetitle = 'Details des utilisateurs';
                require (File::build_path(array('view', 'view.php')));
            }
            else {
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function update() {
        if (isset($_GET['loginUtilisateur'])) {
            $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
            $nom = $u->get('nomUtilisateur');
            $prenom = $u->get('prenomUtilisateur');
            $view = 'update';
            $pagetitle = 'Utilisateur à modifier';
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function updated() {
        if(isset($_GET['loginUtilisateur']) && isset($_GET['nomUtilisateur']) && isset($_GET['prenomUtilisateur'])) {
            $view = 'updated';
            $pagetitle = 'Utilisateur modifié';
            $login = $_GET['loginUtilisateur'];
            $data = array(
                "loginUtilisateur" => $_GET['loginUtilisateur'],
                "nomUtilisateur" => $_GET['nomUtilisateur'],
                "prenomUtilisateur" => $_GET['prenomUtilisateur'],
            );
            $u = new ModelUtilisateurs($data);
            $u->update($data);
            $tab_u = ModelUtilisateurs::selectAll();
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function mdp_oublie() {
        $view = 'mdp_oublie';
        $pagetitle = 'Mot de passe oublié';
        require (File::build_path(array('view', 'view.php')));
    }

}

?>