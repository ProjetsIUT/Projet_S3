
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelFaireExercice extends Model{
    
    protected static $object = 'faireExercice';
    protected static $primary = 'loginEtudiant';

    private $loginEtudiant;
    private $idExercice;
    private $reponse;
    private $date;
    private $correction;
    private $fichier;
     

    public function __construct($loginEtudiant = NULL,$idExercice = NULL,$reponse = NULL, $Date = NULL, $correction = NULL, $fichier = NULL)
    {
        if(isset($idExercice)) $this->$idExercice =$idExercice;
        if(isset($loginEtudiant)) $this->$loginEtudiant =$loginEtudiant;
        if(isset($reponse)) $this->$reponse =$reponse;
        if(isset($date)) $this->$date = $date;
        if(isset($correction)) $this->$correction = $correction;
        if(isset($fichier)) $this->$fichier = $fichier;

    }

    public function getCorrection(){
      return $this->correction;
    }

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

    public static function selectFaireExercice($exercice, $etudiant){
      $table_name = "agora_faireExercice";
      $class_name = 'ModelFaireExercice';
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

    public static function addCorrection($exercice, $etudiant, $correction){
      $table_name = "agora_" .  static::$object;
      $class_name = 'Model'.ucfirst(static::$object);
      $primary_key1 = 'idExercice';
      $primary_key2 = 'loginEtudiant';
      $set = 'correction = \''.$correction.'\'';
      
      $sql = "UPDATE $table_name SET $set WHERE $primary_key1=:val1 AND $primary_key2=:val2";
      $values = array(
        "val1" => $exercice,
        "val2" => $etudiant,
      );

   
              $req_prep = Model::$pdo->prepare($sql);
          
              $req_prep->execute($values);
             
        
      }

      public static function selectByEnseignant($enseignant){
      
      $class_name = 'Model'.ucfirst(static::$object);

      $sql = "SELECT DISTINCT f.idExercice, f.loginEtudiant, f.reponse, f.date, f.correction from agora_faireExercice f 
      JOIN agora_ExerciceClassique e ON e.idExercice = f.idExercice 
      JOIN agora_cours c ON e.themeExercice = c.codeCours 
      JOIN agora_matieres m ON c.codeMatiere = m.codeMatiere
      JOIN agora_enseigner ens ON ens.codeMatiere = m.codeMatiere 
      WHERE codeEnseignant=:val1 AND f.correction is NULL";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL
            
      $values = array(
        "val1" => $enseignant,
      );

      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab_obj = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_obj))
        return false;
      return $tab_obj;

    }


    public static function getAllByEnseignant(){

      $login = $_SESSION['loginUtilisateur'];

           $class_name = 'Model'.ucfirst(static::$object);

      $sql = "SELECT DISTINCT f.idExercice, f.loginEtudiant, f.reponse, f.date, f.correction from agora_faireExercice f 
      JOIN agora_ExerciceClassique e ON e.idExercice = f.idExercice 
      JOIN agora_cours c ON e.themeExercice = c.codeCours 
      JOIN agora_matieres m ON c.codeMatiere = m.codeMatiere
      JOIN agora_enseigner ens ON ens.codeMatiere = m.codeMatiere 
      WHERE codeEnseignant=:val1 AND f.correction is NULL";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL
            
      $values = array(
        "val1" => $login,
      );

      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab_obj = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_obj))
        return false;
      return $tab_obj;
    }

  }

  ?>