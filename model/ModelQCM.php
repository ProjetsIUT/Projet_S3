
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelQCM extends Model {

  protected static $primary = 'codeQCM';
  protected static $object = 'QCM';

	private $codeQCM;
	private $nomQCM;
  private $themeQCM;  //Theme = codeMatiere 
	private $resume;
  private $dateQCM;

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
 
    $this->codeQCM =$data["codeQCM"];
    $this->nomQCM = $data["nomQCM"];
    $this->themeQCM = $data["themeQCM"];
    $this->resume=$data["resume"];
    $this->dateQCM=$data["dateQCM"];

  }
}


  public static function getAllByEtud(){

      $login = '"'.$_SESSION['loginUtilisateur'].'"';

      $sql = "SELECT * from agora_QCM Q JOIN agora_cours C ON Q.themeQCM=C.codeCours
      JOIN agora_matieres M ON M.codeMatiere=C.codeMatiere JOIN agora_suitMatiere S
      ON S.codeMatiere=M.codeMatiere 
      WHERE loginEtudiant=$login";

      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, "ModelQCM");
      $tab_obj = $rep->fetchAll();

      if (empty($tab_obj)) {
         return false;
      }

      return $tab_obj;
    
    

  }


    public static function getAllByEnseignant(){

      $login = '"'.$_SESSION['loginUtilisateur'].'"';

      $sql = "SELECT * from agora_QCM Q JOIN agora_cours C ON Q.themeQCM=C.codeCours
      JOIN agora_matieres M ON M.codeMatiere=C.codeMatiere JOIN agora_enseigner E
      ON E.codeMatiere=M.codeMatiere 
      WHERE codeEnseignant=$login";
      
      $rep = Model::$pdo->query($sql);
      $rep->setFetchMode(PDO::FETCH_CLASS, "ModelQCM");
      $tab_obj = $rep->fetchAll();

      if (empty($tab_obj)) {
         return false;
      }

      return $tab_obj;
    
    

  }



}


?>
