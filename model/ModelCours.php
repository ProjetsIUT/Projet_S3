
<?php


require_once (File::build_path(array('model','Model.php')));

class ModelCours extends Model{


	protected static $object = "cours";
	protected static $primary = "codeCours";


	private $codeCours;
	private $nomCours;
  private $datePublication;
	private $codeMatiere;
	private $accesCours; //Privé ou public, à définir
	private $fichierCours;
  private $resumeCours;


  public function get($nom_attribut) {
    if (property_exists($this, $nom_attribut))
        return $this->$nom_attribut;
    return false;
  }

  
  public function set($nom_attribut, $valeur) {
    if (property_exists($this, $nom_attribut))
        $this->$nom_attribut = $valeur;
    return false;
  }

	 public function __construct($data = array()) {
    
    if (!empty($data)) {

      $this->codeCours=$data['codeCours'];
      $this->nomCours= $data["nomCours"];
      $this->datePublication = $data["datePublication"];
      $this->codeMatiere=$data["codeMatiere"];
      $this->accesCours=$data["accesCours"];
      $this->fichierCours=$data["fichierCours"];
      $this->resumeCours=$data["resumeCours"];

    }


  }


  public static function upload($codeCours){

        
        //Traitement du fichier de correction
        if ($_FILES['fichierCours']['error'] > 0) $error_code = "Erreur lors du transfert du cours";
        $maxsize = 1048576;
        if ($_FILES['fichierCours']['size'] > $maxsize) $error_code = "Le fichier est trop volumineux. Veuillez sélectionner un fichier adapté à la limite imposée";
        
        $extensions_valides = array( 'pdf' , 'docx');
        //strrchr renvoie l'extension avec le point (« . »).
        //substr(chaine,1) ignore le premier caractère de chaine.
        //strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['fichierCours']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ){
            $name = File::build_path(array('data',"{$codeCours}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
          
            $source=$_FILES['fichierCours']['tmp_name'];
            $resultat = move_uploaded_file($source,$name);
        }else{
            $object="";
            $view="error";
            $error_code = "L'extension du fichier choisi est incorrecte. Veuillez sélectionner un fichier adapté au format imposé";
            require (File::build_path(array('view', 'view.php')));
        }
        
        return $name;
  }

  public static function getAllByEtud(){

    //Retourne les cours que l'étudiant à le droit de consulter

          $login = '"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT codeCours from agora_cours C JOIN agora_matieres M
          ON C.codeMatiere=M.codeMatiere JOIN agora_suitMatiere S ON S.codeMatiere=M.codeMatiere
          WHERE loginEtudiant=$login OR C.accesCours=1";

          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codesCours = $rep->fetchAll();

          $tabCours = array();

          foreach ($tab_codesCours as $key) { 

            $cours=self::select($key[0]);
            array_push($tabCours,$cours);

          }

          return $tabCours;



  }


    public static function getAllByEnseignant(){

    //Retourne les cours que l'enseignant possède (dans les matières où il enseigne)

          $login = '"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT codeCours from agora_cours C JOIN agora_matieres M
          ON C.codeMatiere=M.codeMatiere JOIN agora_enseigner E ON E.codeMatiere=M.codeMatiere
          WHERE codeEnseignant=$login";

          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codesCours = $rep->fetchAll();

          $tabCours = array();

          foreach ($tab_codesCours as $key) { 

            $cours=self::select($key[0]);
            array_push($tabCours,$cours);

          }

          return $tabCours;



  }

}  



?>