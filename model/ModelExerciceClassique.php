
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelExerciceClassique extends Model{
    
    protected static $object = 'ExerciceClassique';
    protected static $primary = 'idExercice';
    

    private $idExercice;
    private $nomExercice;
    private $themeExercice;
    private $tempsLimite;

    private $acces;  
    private $enonce; 

     

    public function __construct($idExercice = NULL, $nomExercice = NULL, $themeExercice = NULL, $tempsLimite = NULL, $acces = NULL,$enonce = NULL)
    {
        if(isset($idExercice)){
        
            $this->idExercice =$idExercice; //uniqid genere un String !
            $this->themeExercice=$themeExercice;
        
            $this->nomExercice = $nomExercice;

            $this->acces = $acces;

            $this->tempsLimite = $tempsLimite;

            $this->enonce = $enonce;               
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




