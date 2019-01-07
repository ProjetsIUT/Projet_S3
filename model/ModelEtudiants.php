<?php
 

require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('lib','Security.php')));

class ModelEtudiants extends ModelUtilisateurs {


	  protected static $primary = 'loginEtudiant';
  	  protected static $object = 'etudiants';
  	  
  	  private $anneeCourantEtudiant;
  	  private $SemestreCourantEtudiant;
  	  private $codeDepartement;
  	 
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

	    $this->anneeCourantEtudiant= $data["anneeCourantEtudiant"];
	    $this->SemestreCourantEtudiant = $data["SemestreCourantEtudiant"];
	    $this->codeDepartement=$data["codeDepartement"];
	    $this->moyenneGenerale=$data["moyenneGenerale"];

	  	}
   }


   public static function getAllByEnseignant(){


          $loginEnseignant=$_SESSION['loginUtilisateur'];

          //Retourne tous les enseignants inscrits dans les matières dans lesquelles enseigne un enseignant ($login)

          $login='"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT codeEtudiant from agora_suitMatiere WHERE codeEnseignant=$login";
          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codesMatiere = $rep->fetchAll();

          $tab =array();

          foreach ($tab_codesMatiere as $key) { 

            array_push($tab,$key[0]);

          }


          return $tab;


   }


}



?>
