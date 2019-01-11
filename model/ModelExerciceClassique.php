
<?php

require_once (File::build_path(array('model','Model.php')));

class ModelExerciceClassique extends Model{
    
    protected static $object = 'ExerciceClassique';
    protected static $primary = 'idExercice';
    

    private $idExercice;
    private $nomExercice;
    private $themeExercice;
    private $tempsLimite;
    private $fichier;

 
    private $enonce; 

     

    public function __construct($idExercice = NULL, $nomExercice = NULL, $themeExercice = NULL, $tempsLimite = NULL, $enonce = NULL, $fichier = NULL)
    {
        if(isset($idExercice)){
        
            $this->idExercice =$idExercice; //uniqid genere un String !
            $this->themeExercice=$themeExercice;
        
            $this->nomExercice = $nomExercice;



            $this->tempsLimite = $tempsLimite;

            $this->enonce = $enonce;

            if(isset($fichier)) $this->$fichier = $fichier;              
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

  public static function getAllByEtud(){

      //Retourne les exs que l'étudiant à le droit de consulter

          $login = '"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT idExercice from agora_ExerciceClassique E JOIN agora_cours C
          ON C.codeCours=E.themeExercice JOIN agora_matieres M ON M.codeMatiere=C.codeMatiere JOIN agora_suitMatiere S ON S.codeMatiere=M.codeMatiere
          WHERE loginEtudiant=$login";

          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codes = $rep->fetchAll();


          $tab= array();

          foreach ($tab_codes as $key) { 

            $cours=self::select($key[0]);
            array_push($tab,$cours);

          }

          return $tab;



  }

  public static function getAllByEnseignant(){

      //Retourne les exs que l'enseignany à le droit de consulter

          $login = '"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT idExercice from agora_ExerciceClassique E JOIN agora_cours C
          ON C.codeCours=E.themeExercice JOIN agora_matieres M ON M.codeMatiere=C.codeMatiere JOIN agora_enseigner S ON S.codeMatiere=M.codeMatiere
          WHERE codeEnseignant=$login";

          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codes = $rep->fetchAll();

          $tab= array();

          foreach ($tab_codes as $key) { 

            $cours=self::select($key[0]);
            array_push($tab,$cours);

          }

          return $tab;



  }

}




