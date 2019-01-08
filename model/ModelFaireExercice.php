
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelExerciceClassique extends Model{
    
    protected static $object = 'FaireExercice';
    protected static $primary = array('exercice' =>'idExercice', 'etudiant' =>'loginEtudiant');
    
    private $loginEtudiant;
    private $idExercice;
    private $reponse;
     

    public function __construct($loginEtudiant = NULL,$idExercice = NULL,$reponse = NULL)
    {
        if(isset($idExercice)) $this->$idExercice =$idExercice;
        if(isset($loginEtudiant)) $this->$loginEtudiant =$loginEtudiant;
        if(isset($reponse)) $this->$reponse =$reponse; 
                       
    
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




