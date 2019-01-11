
<?php


require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('lib','Security.php')));

class ModelEnseignants extends ModelUtilisateurs {

	  protected static $primary = 'loginEnseignant';
  	  protected static $object = 'enseignants';

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

	  	}
	 }

}

?>
