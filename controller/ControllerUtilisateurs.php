
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

    public static function validate_new_password() {
        $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
        $nr = $_GET['nonce'];
        if ($u) {
            if ($nr === $u->get('nonce')) {
                if(isset($_GET['mdpUtilisateur']) && isset($_GET['vmdpUtilisateur'])) {
                    if($_GET['mdpUtilisateur'] === $_GET['vmdpUtilisateur']) {
                        $mdp_crypte = Security::chiffrer($_GET['mdpUtilisateur']);
                        $data = array(
                            "loginUtilisateur"=>$_GET["loginUtilisateur"],
                            "mdpUtilisateur"=> $mdp_crypte,
                            "nonce" => NULL,
                        );
                        $u = new ModelUtilisateurs();
                        $u->update($data);
                        $view = 'validate';
                        $pagetitle = 'Mot de passe changé et Compte validé - Agora';
                        require (File::build_path(array('view', 'view.php')));
                    }
                    else {
                        $verif = 'Vos deux mots de passe ne sont pas identiques';
                        $pagetitle="Première connexion - Agora";
                        $view = 'definirMdp';
                        require (File::build_path(array('view', 'view.php')));
                    }
                }
                else {
                    $error_code = 'validate_new_password : l\'un des champs est vide';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                }
            }
            else if($u->get('nonce') == NULL){
                $error_code = 'validate_new_password : Votre compte a déja été validé';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
            else {
                $error_code = 'validate_new_password : Nous ne pouvons accéder à votre requête';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'validate_new_password : loginUtilisateur inexistant';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

	public static function show_login_page(){
        if(!isset($_SESSION['loginUtilisateur'])) {
            $view='login';
            $pagetitle="Connexion - Agora";
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $error_code = 'connect : vous êtes déja connecté';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function show_error_page() {
        $error_code = 'Erreur';
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if($error === '404') {
                $error_code = 'Erreur 404 - Document Introuvable';
            }
        }
        $pagetitle = 'Erreur';
        require (File::build_path(array('view', 'error.php')));

    }
 
    public static function connect() {
        if(isset($_GET['loginUtilisateur']) && isset($_GET['mdpUtilisateur'])){ //succès: l'utilisateur est connecté
            $login=$_GET['loginUtilisateur'];
            $password=$_GET['mdpUtilisateur'];
            $mdpsecu = Security::chiffrer($password);
            $verif = ModelUtilisateurs::checkPassword($login, $mdpsecu);
            $u = ModelUtilisateurs::select($login);
            if($u) {
                if($verif) {
                    if($u->get('nonce') == NULL) {
                        $_SESSION['loginUtilisateur'] = $u->get('loginUtilisateur');
                        $_SESSION['mdpUtilisateur'] = $u->get('mdpUtilisateur');
                        $_SESSION['typeUtilisateur'] = $u->get('typeUtilisateur');
                        $_SESSION['nomUtilisateur'] = $u->get('nomUtilisateur');
                        $_SESSION['prenomUtilisateur'] = $u->get('prenomUtilisateur');
                        $_SESSION['emailUtilisateur'] = $u->get('emailUtilisateur');
                        $_SESSION['codeEtablissement'] = $u->get('codeUtilisateur');
                        
                        if($_SESSION["typeUtilisateur"] === "etudiant"){ //si c'est un étudiant 
                            $redirection = 'index.php?controller=etudiants&action=show_perso_page';
                            header('Location: '.$redirection);
                        }
        
                        if($_SESSION["typeUtilisateur"] === "enseignant"){ //si c'est un enseignant
                            $redirection = 'index.php?controller=enseignants&action=show_perso_page';
                            header('Location: '.$redirection);
                        }
        
                        if($_SESSION["typeUtilisateur"] === "administrateur"){ //si c'est un admin
                            $redirection = 'index.php?controller=administrateur&action=show_perso_page';
                            header('Location: '.$redirection);
                        }
                    }
                    else {
                        $view='login';
                        $pagetitle = 'Connexion - Agora';
                        $code_connect_failed = 'error_compte_invalide';
                        require (File::build_path(array('view', 'view.php')));
                    }
                }
                else { //échec: mauvais mdp
                    $view='login';
                    $pagetitle="Connexion - Agora";
                    $code_connect_failed='error_mdp';
                    require (File::build_path(array('view', 'view.php')));
                }
            }
            else{ //échec: utilisateur non inscrit
                $view='login';
                $pagetitle="Connexion - Agora";
                $code_connect_failed='error_user';
                require (File::build_path(array('view', 'view.php')));
            }
        } 
        else { //échec: loginUtilisateur ou Mot de passe vide
            $error_code = 'connect : login ou mot de passe vide';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function recuparemail() {
        $vemail = filter_var($_GET['email'] , FILTER_VALIDATE_EMAIL);
        $u = ModelUtilisateurs::getUserByEmail($_GET['email']);
        if($vemail) {
            if($u) {
                $destinataire = $_GET['email'];
                $sujet = 'Récupération de mot de passe';
                $entete = 'From agoradmin@agora.fr';
                $mail = 'Bonjour '.htmlspecialchars($u->get('prenomUtilisateur')).',
                

                Pour changer votre mot de passe, veuillez cliquer sur le lien-ci dessous ou 
                copier/coller dans votre navigateur internet :
                
                http://webinfo.iutmontp.univ-montp2.fr/~bourdesj/Projet_S3/index.php?controller=utilisateurs&action=changemdp&loginUtilisateur='.$u->get('loginUtilisateur').'

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


    public static function changemdp() {
        $view = 'changemdp';
        $pagetitle= "Nouveau mot de passe";
        require (File::build_path(array('view', 'view.php')));
    }

    public static function changemdpfait() {
        if(isset($_GET['mdp']) && isset($_GET['vmdp'])) {
            if($_GET['mdp'] === $_GET['vmdp']) {
                $view = 'changemdpfait';
                $pagetitle = "Mot de passe changé";
                $mdpsecu = Security::chiffrer($_GET['mdp']);
                $u = new ModelUtilisateurs();
                $data = array(
                    "loginUtilisateur" => $_GET['loginUtilisateur'],
                    "mdpUtilisateur" => $mdpsecu,
                );
                $u->update($data);
                require (File::build_path(array('view', 'view.php')));
            }
            else {
                $verif = "Vos mots de passe ne sont pas identiques";
                $view = 'changemdp';
                $pagetitle = "Nouveau mot de passe";
                require (File::build_path(array('view', 'view.php')));
            }
        }
        else {
            $error_code = 'changemdpfait : l\'un des champs est vide';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function create() {
        if(Session::is_admin()) {
            $type = 'Ajout d\'un utilisateur';
            $view = 'update';
            $pagetitle = 'Ajout d\'un utilisateur - 1/2 - Agora';
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $error_code = 'Impossible de créer un compte. Contactez l\'administrateur de votre université pour tout renseignement';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function created() {
        if(isset($_GET['loginUtilisateur']) && isset($_GET['nomUtilisateur']) && isset($_GET['prenomUtilisateur']) && isset($_GET['emailUtilisateur']) && isset($_GET['typeUtilisateur']) && isset($_GET['codeEtablissement'])) {
            $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
            if($u == false) {
                $vemail = filter_var($_GET['emailUtilisateur'] , FILTER_VALIDATE_EMAIL);
                if ($vemail) {
                    $um = ModelUtilisateurs::getUserByEmail($_GET['emailUtilisateur']);
                    if($um == false) {
                        $nonc = Security::generateRandomHex();
                        $mdpsecu = Security::chiffrer($nonc);
                        $data = array(
                        "loginUtilisateur" => $_GET['loginUtilisateur'],
                        "nomUtilisateur" => $_GET['nomUtilisateur'],
                        "prenomUtilisateur" => $_GET['prenomUtilisateur'],
                        "mdpUtilisateur" => $mdpsecu,
                        "emailUtilisateur" => $_GET['emailUtilisateur'],
                        "typeUtilisateur" => $_GET['typeUtilisateur'],
                        "codeEtablissement" => $_GET['codeEtablissement'],
                        "nonce" => $nonc,
                        );
                        $u = new ModelUtilisateurs();
                        $u->save($data);
                        $destinataire = $_GET['emailUtilisateur'];
                        $sujet = 'Activer votre compte';
                        $entete = 'From serviceclient@agora.com';
                        $mail = 'Bienvenue sur Agora,
                        
                        Voici votre identifiant de connexion : '.$_GET['loginUtilisateur'].'

                        Pour activer votre compte, veuillez cliquer sur le lien-ci dessous ou 
                        copier/coller dans votre navigateur internet

                        http://webinfo.iutmontp.univ-montp2.fr/~bourdesj/Projet_S3/index.php?controller=utilisateurs&action=show_password_page&loginUtilisateur='.rawurlencode($_GET['loginUtilisateur']).'&nonce='.rawurlencode($nonc).'


                        Ceci est un mail automatique, Merci de ne pas y répondre
                        
                        ';
                        mail($destinataire, $sujet, $mail, $entete);
                        
                        if($_GET["typeUtilisateur"] === "etudiant"){ //si c'est un étudiant 
                            $redirection = 'index.php?controller=etudiants&action=create_info_etud&loginUtilisateur='.rawurlencode($_GET['loginUtilisateur']).'';
                            header('Location: '.$redirection);
                        }
        
                        if($_GET["typeUtilisateur"] === "enseignant"){ //si c'est un enseignant
                            $redirection = 'index.php?controller=enseignants&action=create_info_enseig&loginUtilisateur='.rawurlencode($_GET['loginUtilisateur']).'';
                            header('Location: '.$redirection);
                        }
                    }
                    else {
                        $type = 'Ajout';
                        $verif = 'Cette email est déja utilisé';
                        $view = 'update';
                        $pagetitle = 'Ajout d\'un utilisateur - 1/2 - Agora';
                        require (File::build_path(array('view', 'view.php'))); 
                    }
                }
                else {
                    $type = 'Ajout';
                    $verif = 'Votre email n\'est pas valide !';
                    $view = 'update';
                    $pagetitle = 'Ajout d\'un utilisateur - 1/2 - Agora';
                    require (File::build_path(array('view', 'view.php')));
                }
            }
            else {
                $type = 'Ajout';
                $verif = 'Ce nom d\'utilisateur existe déja';
                $view = 'update';
                $pagetitle = 'Ajout d\'un utilisateur - 1/2 - Agora';
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
        if(isset($_SESSION['loginUtilisateur'])) {
            session_unset(); 
            session_destroy();
            $redirection = 'index.php?controller=Utilisateurs&action=show_login_page';
            header('Location: '.$redirection);
        }
        else {
            $error_code = 'deconnect : vous êtes déja deconnecté';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function delete() {

        if(isset($_GET['loginUtilisateur'])) {
            if (Session::is_user($_GET['loginUtilisateur']) || Session::is_admin()) {
                $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
                if($u) {
                    ModelUtilisateurs::delete($_GET['loginUtilisateur']);
                    if($u->get('typeUtilisateur') === 'etudiant') {
                        $redirection = 'index.php?controller=etudiants&action=delete&loginEtudiant='.$_GET['loginUtilisateur'];
                        header('Location: '.$redirection);
                    }
                    else if($u->get('typeUtilisateur') === 'enseignant') {
                        $redirection = 'index.php?controller=enseignants&action=delete&loginEnseignant='.$_GET['loginUtilisateur'];
                        header('Location: '.$redirection);
                    }
                    else {
                        $view = 'deleted';
                        $pagetitle = 'Administrateur supprimé';
                        require (File::build_path(array('view', 'error.php')));
                    }
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

	public static function readAll() {
        if(Session::is_admin()) {
            $tab_u = ModelUtilisateurs::selectAll();
            $view = 'list';
            $pagetitle = 'Liste des utilisateurs';
            require (File::build_path(array('view', 'view.php')));
        }
        else {
            $pagetitle = 'Erreur';
            $error_code = 'readAll : Vous n\'avez pas acceder à ces informations !';
            require File::build_path(array('view', 'error.php'));
        }
    }

    public static function read() {
        if(isset($_GET['loginUtilisateur'])) {
            $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
            if($u) {
                if (Session::is_user($_GET['loginUtilisateur']) || Session::is_admin()) {
                    $ulogin = $u->get('loginUtilisateur');
                    $uprenom = $u->get('prenomUtilisateur');
                    $unom = $u->get('nomUtilisateur');
                    $uemail = $u->get('emailUtilisateur');
                    $ucode = $u->get('codeEtablissement');
                    $utype = $u->get('typeUtilisateur');
                    $view = 'detail';
                    if(Session::is_user($_GET['loginUtilisateur'])) {
                        $pagetitle = 'Mes informations utilisateurs';
                    }
                    $pagetitle = "Détails utilisateurs";
                    require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'read : Vous ne pouvez pas avoir accès à des informations confidentiels sur d\'autre utilisateurs';
                    $view = 'error';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                }
            }
            else {
                $error_code = 'read : loginUtilisateur inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'read : loginUtilisateur vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }

    public static function mdp_oublie() {
        $view = 'mdp_oublie';
        $pagetitle = 'Mot de passe oublié';
        require (File::build_path(array('view', 'view.php')));
    }

 
    public static function update() {
        $type = "Modification";
        if (isset($_GET['loginUtilisateur'])) {
            $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
            if($u) {
                if (Session::is_user($_GET['loginUtilisateur']) && !Session::is_admin()) {
                        $ulogin = $u->get('loginUtilisateur');
                        $uprenom = $u->get('prenomUtilisateur');
                        $unom = $u->get('nomUtilisateur');
                        $uemail = $u->get('emailUtilisateur');
                        $ucodeEtablissement = $u->get('codeEtablissement');
                        $type = "Modification de mes informations";
                        $etat = 'readonly required';
                        $view = 'update';
                        $pagetitle = 'Mes informations personnelles';
                        require (File::build_path(array('view', 'view.php')));
                }
                else if(Session::is_admin()) {
                    $ulogin = $u->get('loginUtilisateur');
                    $uprenom = $u->get('prenomUtilisateur');
                    $unom = $u->get('nomUtilisateur');
                    $uemail = $u->get('emailUtilisateur');
                    $ucodeEtablissement = $u->get('codeEtablissement');
                    $utype = $u->get('typeUtilisateur');
                    $type = 'Modification des informations de l\'utilisateur '.$ulogin;
                    $etat = 'required';
                    $view = 'update';
                    $pagetitle = 'Utilisateur '.$ulogin;
                    require (File::build_path(array('view', 'view.php')));
                }
                else {
                    $error_code = 'update : vous n\'avez pas accès à ces données';
                    $view = 'error';
                    $pagetitle = 'Erreur';
                    require (File::build_path(array('view', 'error.php')));
                } 
            }
            else {
                $error_code = 'update : utilisateur inexistant';
                $view = 'error';
                $pagetitle = 'Erreur';
                require (File::build_path(array('view', 'error.php')));
            }
        }
        else {
            $error_code = 'update : loginUtilisateur vide';
            $view = 'error';
            $pagetitle = 'Erreur';
            require (File::build_path(array('view', 'error.php')));
        }
    }


    public static function updated() {
        if(isset($_GET['loginUtilisateur']) && isset($_GET['nomUtilisateur']) && isset($_GET['prenomUtilisateur']) && isset($_GET['emailUtilisateur']) && isset($_GET['typeUtilisateur']) && isset($_GET['codeEtablissement'])) {
            $u = ModelUtilisateurs::select($_GET['loginUtilisateur']);
            if($u) {
                if (Session::is_user($_GET['loginUtilisateur'])) {
                    $etat = 'required readonly';
                    $view = 'updated';
                    $pagetitle = 'Utilisateur ajouté';
                    $data = array(
                        "loginUtilisateur" => $_GET['loginUtilisateur'],
                        "nomUtilisateur" => $_GET['nomUtilisateur'],
                        "prenomUtilisateur" => $_GET['prenomUtilisateur'],
                        "emailUtilisateur" => $_GET['emailUtilisateur'],
                        "codeEtablissement" => $_GET['codeEtablissement'],
                    );
                    $u = new ModelUtilisateurs($data);
                    $u->update($data);
                    require (File::build_path(array('view', 'view.php')));
                }
                else if(Session::is_admin()) {
                    $etat = 'required';
                    $view = 'updated';
                    $pagetitle = 'Utilisateur ajouté';
                    $data = array(
                        "loginUtilisateur" => $_GET['loginUtilisateur'],
                        "nomUtilisateur" => $_GET['nomUtilisateur'],
                        "prenomUtilisateur" => $_GET['prenomUtilisateur'],
                        "emailUtilisateur" => $_GET['emailUtilisateur'],
                        "typeUtilisateur" => $_GET['typeUtilisateur'],
                        "codeEtablissement" => $_GET['codeEtablissement'],
                    );
                    $u = new ModelUtilisateurs($data);
                    $u->update($data);
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
                $error_code = 'updated : ce loginUtilisateur est inexistant';
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

    public static function show_home_page() {
        if(Session::is_student()){ //si c'est un étudiant 
            $redirection = 'index.php?controller=etudiants&action=show_perso_page';
            header('Refresh: 3; url='.$redirection);
        }
        else if(Session::is_teacher()){ //si c'est un enseignant
            $redirection = 'index.php?controller=enseignants&action=show_perso_page';
            header('Refresh: 3; url='.$redirection);
        }
        else if(Session::is_admin()){ //si c'est un admin
            $redirection = 'index.php?controller=administrateur&action=show_perso_page';
            header('Refresh: 3; url='.$redirection);
        }
        else {
            $redirection = 'index.php';
            header('Refresh: 3; url='.$redirection);
        }
    }


}


?>