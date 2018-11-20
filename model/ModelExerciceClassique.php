
<?php



class ModelExerciceClassique extends Model
{


    private $idExercice;

    private $nomExercice;

    private $difficulte;
    
    private $tempsLimite;


    private $coeff;


    private $acces;
    
    private $ennonce;
    
    private $correction;
         


    public function __construct($idExercice, $nomExercice, $difficulte, $tempsLimite = NULL, $coeff = NULL, $acces, $ennonce, $Correction)
    {
        
        $this->$idExercice =$idExercice; //uniqid genere un String !
        
        $this->$nomExercice = $nomExercice;
        $this->$difficulte = $difficulte;
        $this->$acces = $acces;

        $this->$tempsLimite = $tempsLimite;
        $this->$coeff = $coeff;
        $this->$ennonce = $enonce;
        $this->$correction = $correction;
        
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

    public function save(){
    $sql = "INSERT INTO agora_exerciceClassique VALUES (:idExercice,:nomExercice,:difficulte,:tempsLimite,:coeff,:acces,:ennonce)";

    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "idExercice" => $this->$idExercice,
        "nomExercice" => $this->$nomExercice,
        "difficulte" => $this->$difficulte,
        "tempsLimite" => $this->$tempsLimite,
        "coeff" => $this->$coeff,
        "acces" => $this->$acces,
        "ennonce" => $this->$ennonce,
    );
    $req_prep->execute($values);
    
  }
}
    




