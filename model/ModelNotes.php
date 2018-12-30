<?php

require_once (File::build_path(array('model','Model.php')));

class ModelNotes extends Model{

    protected static $object = 'notes';
    protected static $primary = 'codeNote';

    private $codeNote;
    private $codeEtudiant;
    private $codeExercice;
    private $typeExercice;
    private $note;



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

      $this->codeNote=$data['codeNote'];
      $this->codeEtudiant= $data["codeEtudiant"];
      $this->codeExercice = $data["codeExercice"];
      $this->typeExercice=$data["typeExercice"];
      $this->note=$data["note"];


    }


  }


     public static function selectByEtud() {

     		$login = '"'.$_SESSION['loginUtilisateur'].'"';

            $sql = "SELECT * from agora_notes WHERE codeEtudiant=$login";
            $rep = Model::$pdo->query($sql);

		        $rep->setFetchMode(PDO::FETCH_CLASS, "ModelNotes");
            $tab_obj = $rep->fetchAll();

            return $tab_obj;
     }

}

?>