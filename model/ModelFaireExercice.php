
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelFaireExercice extends Model{
    
    protected static $object = 'faireExercice';

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

    public static function selectFaireExercice($exercice, $etudiant){
      $table_name = "agora_" .  static::$object;
      $class_name = 'Model'.ucfirst(static::$object);
      $primary_key1 = 'idExercice';
      $primary_key2 = 'loginEtudiant';
      
      $sql = "SELECT * from $table_name WHERE $primary_key1=:val1 AND $primary_key2=:val2";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL
            
      $values = array(
        "val1" => $exercice,
        "val2" => $etudiant,
      );

      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab_obj = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_obj))
        return false;
      return $tab_obj[0];
    }
  }





