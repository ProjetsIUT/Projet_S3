
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelExerciceClassique extends Model{
    
    protected static $object = 'ExerciceClassique';
    protected static $primary = 'idExercice';
    

    private $idExercice;
    private $nomExercice;
    private $difficulte;
    private $tempsLimite;
    private $coeff;
    private $acces;  
    private $ennonce; 
    private $reponse;
     

    public function __construct($idExercice = NULL, $nomExercice = NULL, $difficulte = NULL, $tempsLimite = NULL, $coeff = NULL, $acces = NULL,$enonce = NULL)
    {
        if(isset($idExercice)){
        
            $this->$idExercice =$idExercice; //uniqid genere un String !
        
            $this->$nomExercice = $nomExercice;
            $this->$difficulte = $difficulte;
            $this->$acces = $acces;

            $this->$tempsLimite = $tempsLimite;
            $this->$coeff = $coeff;
            $this->$enonce = $enonce;               
        }
    
    }

    // Getter générique (pas expliqué en TD)
  public function get($nom_attribut) {
    if (property_exists($this, $nom_attribut))
        return $this->$nom_attribut;
    return false;
  }

  // Setter générique (pas expliqué en TD)
  public function set($nom_attribut, $valeur) {
    if (property_exists($this, $nom_attribut))
        $this->$nom_attribut = $valeur;
    return false;
  }

}



