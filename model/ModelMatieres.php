<?php

$path=array('model','Model.php');
require_once File::build_path($path);

class ModelMatieres extends Model {

	protected static $object="matieres";
	protected static $primary="codeMatiere";

	protected $codeMatiere;
	protected $nomMatiere;
	protected $coeff;
	protected $codeDepartement;

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

      $this->codeMatiere=$data['codeMatiere'];
      $this->nomMatiere= $data["nomMatiere"];
      $this->coeff=$data["coeff"];
      $this->codeDepartement=$data["codeDepartement"];

    }


  }



}


?>