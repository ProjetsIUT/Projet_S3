
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelFaireExercice extends Model{
    
    protected static $object = 'faireExercice';
    protected static $primary = array('exercice' =>'idExercice', 'etudiant' =>'loginEtudiant');
    
    private $loginEtudiant;
    private $idExercice;
    private $reponse;
    private $date;
     

    public function __construct($loginEtudiant = NULL,$idExercice = NULL,$reponse = NULL, $Date = NULL)
    {
        if(isset($idExercice)) $this->$idExercice =$idExercice;
        if(isset($loginEtudiant)) $this->$loginEtudiant =$loginEtudiant;
        if(isset($reponse)) $this->$reponse =$reponse;
        if(isset($date)) $this->$date = $date; 
                       
    
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




