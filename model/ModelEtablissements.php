<<<<<<< HEAD
<?php
 
require_once (File::build_path(array('model','Model.php')));

class ModelEtablissements extends Model {


	  protected static $primary = 'codeEtablissement';
  	  protected static $object = 'etablissements';
      
      private $codeEtablissement;
  	  private $nomEtablissement;
  	  private $villeEtablissement;
  	 
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
            $arr = array();
            $arr = get_class_vars("ModelEtablissements");

            foreach ($arr as $k) {
                $arr[$k] = $attrib;
                if(isset($attrib)) {
                $this->attrib = $data[$k];
                }
            } 
            //$this->anneeCourantEtudiant= $data["anneeCourantEtudiant"];
            //$this->SemestreCourantEtudiant = $data["SemestreCourantEtudiant"];
            //$this->codeDepartement=$data["codeDepartement"];
            //$this->moyenneGenerale=$data["moyenneGenerale"];
        }
    }
=======
<?php
 
require_once (File::build_path(array('model','Model.php')));

class ModelEtablissements extends Model {


	  protected static $primary = 'codeEtablissement';
  	  protected static $object = 'etablissements';
      
      private $codeEtablissement;
  	  private $nomEtablissement;
  	  private $villeEtablissement;
  	 
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
            $arr = array();
            $arr = get_class_vars("ModelEtablissements");

            foreach ($arr as $k) {
                $arr[$k] = $attrib;
                if(isset($attrib)) {
                $this->attrib = $data[$k];
                }
            } 
            //$this->anneeCourantEtudiant= $data["anneeCourantEtudiant"];
            //$this->SemestreCourantEtudiant = $data["SemestreCourantEtudiant"];
            //$this->codeDepartement=$data["codeDepartement"];
            //$this->moyenneGenerale=$data["moyenneGenerale"];
        }
    }
>>>>>>> 5c6a9e9758a9107997232129712afae8a5c64ff2
}