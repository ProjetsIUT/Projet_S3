<?php

require_once (File::build_path(array('model','Model.php')));

class ModelQuestions extends Model{


  protected static $primary = 'codeQuestion';
  protected static $object = 'questions';

  private $codeQuestion;
  private $codeQCM;
  private $intitule;
  private $proposition1;
  private $proposition2;
  private $proposition3;
  private $proposition4;
  private $propositionExacte;

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
	 
	    $this->codeQuestion =$data["codeQuestion"];
	    $this->codeQCM = $data["codeQCM"];
	    $this->intitule = $data["intitule"];
	    $this->proposition1=$data["proposition1"];
	    $this->proposition2=$data["proposition2"];
	    $this->proposition3=$data["proposition3"];    
	    $this->proposition4=$data["proposition4"];
	    $this->propositionExacte=$data["propositionExacte"];


	  }
 }


}

?>