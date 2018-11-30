
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelQCM extends Model {
	protected static $object = 'repondreQCM';
	private $question1;
	private $question2;
	private $question3;
	private $question4;
	private $question5;
	private $question6;
	private $question7;
	private $question8;
	private $question9;
	private $question10;

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
 
    $this->question1 =$data["codeQCM"];
    $this->question2 = $data["nomQCM"];
    $this->question3 =$data["question"];
    $this->question4 =$data["proposition1"];
    $this->question5 =$data["proposition2"];
    $this->question6 =$data["proposition3"];    
    $this->question7 =$data["proposition4"];
    $this->question8 =$data["propositionCorrecte"];
    $this->question9 = $data["nomQCM"];
    $this->question10 = $data["nomQCM"];


  }
}









}


?>
