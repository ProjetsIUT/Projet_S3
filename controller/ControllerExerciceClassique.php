
<?php

require_once (File::build_path(array('model','ModelExerciceClassique.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelFaireExercice.php')));

Class ControllerExerciceClassique {
    
    protected static $object = 'ExerciceClassique';
    
    public static function creerExercice()
    {
        if(!Session::is_teacher()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{

        $view="creer";

	    $pagetitle="Créer un nouvel exercice - Agora";

        $path_array = array("view", "view.php");

        $PATH = File::build_path($path_array);
        require "$PATH";
    }
    }
    
    public static function created(){
        $idExercice = uniqid(); //String
        $nomExercice = $_POST['nomExercice'];
        $tempsLimite = $_POST['tempsLimite'];
        $enonce = $_POST['enonce'];
        $themeExercice=$_POST['theme'];
        
        if(is_uploaded_file($_FILES['correction']['tmp_name'])){

        //Traitement du fichier de correction
        if ($_FILES['correction']['error'] > 0) $error_code = "Erreur lors du transfert de la correction";
        $maxsize = 1048576;
        if ($_FILES['correction']['size'] > $maxsize) $error_code = "Le fichier est trop gros";
        
        $extensions_valides = array('pdf', 'docx');
        //strrchr renvoie l'extension avec le point (« . »).
        //substr(chaine,1) ignore le premier caractère de chaine.
        //strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['correction']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ){
            //$name = File::build_path(array('lib',"corrections/{$idExercice}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
            $name = "./lib/corrections/".$idExercice.".".$extension_upload;
            $resultat = move_uploaded_file($_FILES['correction']['tmp_name'],$name);
        }else{
            $error_code = "extension incorecte";
        }
        }
        if (isset($error_code)){
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{
            if(!isset($name)) $name = NULL;
            $data = array("idExercice" => $idExercice,"nomExercice" => $nomExercice, "themeExercice"=>$themeExercice, "tempsLimite" => $tempsLimite, "enonce" =>$enonce, "fichier" => $name);
            $e = new ModelExerciceClassique($idExercice,$nomExercice, $tempsLimite, $enonce, $name);
            $e->save($data);
            
            header('Location: ./index.php?controller=ExerciceClassique&action=list');
        }
        
    }

    public static function faireExercice(){
        if(!isset($_SESSION['loginUtilisateur'])){

            header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
        }

        if(!Session::is_student()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{

        $id = $_GET['id'];
        
        $e = ModelExerciceClassique::select($id);
              
        $nomE = $e->get('nomExercice');
        $enonce = $e->get('enonce');
        
        $view="faire";
	    $pagetitle="Faire exercice - Agora";
        $path_array = array("view", "view.php");

        $PATH = File::build_path($path_array);
        require "$PATH";
    }}

   public static function list(){

    if(!isset($_SESSION['loginUtilisateur'])){

            header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
        }

        if(Session::is_teacher()){

            $tab=ModelExerciceClassique::getAllByEnseignant();
            $view="list_all";
            $pagetitle="Mes Exercices - Agora";
            require (File::build_path(array('view', 'view.php')));
        }else{

             self::list_a_faire();
        }



        

    } 

        public static function suppr(){

        $id = $_GET["code"];
        ModelExerciceClassique::delete($id);
        self::list();

    }

    public static function list_en_attente(){
         if(!isset($_SESSION['loginUtilisateur'])){

            header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
        }

         if(!Session::is_student()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{
        $loginEtudiant = $_SESSION['loginUtilisateur'];

        $tabe = ModelExerciceClassique::getAllByEtud();
        $tab = array();
        $dates = array();

        foreach ($tabe as $e) {
            $id = $e->get("idExercice");
            
            $test = ModelFaireExercice::selectFaireExercice($id, $loginEtudiant);
        

            if($test){
                
                $correction = $test->getCorrection();
                
                if (NULL==$correction)
                $tab[] = $e;
                $dates[] = $test->get("date");

            }

        }

        $view="listAttente";
        $pagetitle="Mes Exercices - Agora";
        require (File::build_path(array('view', 'view.php')));
        }
    }

    public static function list_a_faire(){
        
        if(!isset($_SESSION['loginUtilisateur'])){

            header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
        }
         
         if(!Session::is_student()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{
        $loginEtudiant = $_SESSION['loginUtilisateur'];

        $tabe = ModelExerciceClassique::getAllByEtud();
        $tab = array();

        foreach ($tabe as $e) {
            $id = $e->get("idExercice");
            
            $test = ModelFaireExercice::selectFaireExercice($id, $loginEtudiant);
        

            if(!$test){
                
                $tab[] = $e;
            }

        }

        $view="list_all";
        $pagetitle="Mes Exercices - Agora";
        require (File::build_path(array('view', 'view.php')));
    }
    }

    public static function list_a_corriger(){
         
         if(!isset($_SESSION['loginUtilisateur'])){

            header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
        }

         if(!Session::is_teacher()){
            $error_code = "acces non autorisé";
            $pagetitle="Erreur - Agora";
            require (File::build_path(array('view', 'error.php')));
        }else{
        $tab = ModelFaireExercice::selectByEnseignant($_SESSION['loginUtilisateur']);
        
        $view="listCorriger";
        $pagetitle="Mes Exercices - Agora";
        require (File::build_path(array('view', 'view.php')));
        

    }
    }
 
}

?>
