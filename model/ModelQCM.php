<?php

require_once (File::build_path(array('model','Model.php')));

class ModelQCM extends Model {

  protected static $primary = 'codeQCM';
  protected static $object = 'QCM';

	private $codeQCM;
	private $nomQCM;
	private $question;
	private $proposition1;
  private $proposition2;
  private $proposition3;
  private $proposition4;
  private $propositionCorrecte;

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
  
    $this->codeQCM=uniqid();
    $this->nomQCM = $data["nomQCM"];
    $this->question=$data["question"];
    $this->proposition1=$data["proposition1"];
    $this->proposition2=$data["proposition2"];
    $this->proposition3=$data["proposition3"];    
    $this->proposition4=$data["proposition4"];
    $this->propositionCorrecte=$data["propositionCorrecte"];


  }
}









}


?>
