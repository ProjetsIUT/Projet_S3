
<?php


require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('lib','Security.php')));

class ModelEnseigner {

	  protected static $primary = 'CodeEnseignant';
  	  protected static $object = 'enseigner';

  	private $loginEnseignant;


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

		    $this->loginEnseignant=$data["loginEnseignant"];
		    $this->codeMatiere=$data["codeMatiere"];

	  	}
	 }

	 public static function selectEnseigner($enseignant){
      $table_name = "agora_enseigner";
      $class_name = 'ModelEnseigner';
      $primary_key1 = 'CodeEnseignant';

      
      $sql = "SELECT * from $table_name WHERE $primary_key1=:val1";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL
            
      $values = array(
        "val1" => $enseignant,
      );

      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab_obj = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_obj))
        return false;
      return $tab_obj;
    }

    
}



?>
