
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


}


?>
