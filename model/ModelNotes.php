
<?php

require_once (File::build_path(array('model','Model.php')));
require_once (File::build_path(array('model','ModelEtudiants.php')));

class ModelNotes extends Model{

    protected static $object = 'notes';
    protected static $primary = 'codeNote';

    private $codeNote;
    private $codeEtudiant;
    private $codeExercice;
    private $typeExercice;
    private $note;
    private $dateNote;

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

      $this->codeNote=$data['codeNote'];
      $this->codeEtudiant= $data["codeEtudiant"];
      $this->codeExercice = $data["codeExercice"];
      $this->typeExercice=$data["typeExercice"];
      $this->note=$data["note"];
      $this->datenote=$data["dateNote"];


    }


  }
    public static function getNotesByMatieresAndEtud($cMatiere) {
      $sql = "SELECT an.codeNote
              FROM agora_notes an
              JOIN agora_QCM aq ON an.codeExercice = aq.codeQCM
              JOIN agora_cours ac ON aq.themeQCM = ac.codeCours
              JOIN agora_matieres am ON ac.codeMatiere = am.codeMatiere
              WHERE an.codeEtudiant=:codeE AND am.codeMatiere=:codeM
              UNION
              SELECT an.codeNote 
              FROM agora_notes an
              JOIN agora_ExerciceClassique aec ON an.codeExercice = aec.idExercice
              JOIN agora_cours ac ON aec.idExercice = ac.codeCours
              JOIN agora_matieres am ON ac.codeMatiere = am.codeMatiere
              WHERE an.codeEtudiant=:codeE AND am.codeMatiere=:codeM";

      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "codeE" => $_SESSION['loginUtilisateur'],
        "codeM" => $cMatiere,
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_NUM);
      $tab_user = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_user)) {
        return false;
      }
      
      $tab = array();

      foreach ($tab_user as $key) { 
        array_push($tab,$key[0]);
      }

      return $tab;
    }

     public static function selectByEtud() {

     	    	$login = '"'.$_SESSION['loginUtilisateur'].'"';

            $sql = "SELECT * from agora_notes WHERE codeEtudiant=$login";
            $rep = Model::$pdo->query($sql);

		        $rep->setFetchMode(PDO::FETCH_CLASS, "ModelNotes");
            $tab_obj = $rep->fetchAll();

            if (empty($tab_obj)) {
              return false;
            }

            return $tab_obj;
     }


     public static function moyenneGenerale($login=NULL,$date = NULL){

          if (!isset($login)){

           $login = '"'.$_SESSION['loginUtilisateur'].'"';

         }else{

           $login='"'.$login.'"';

         }

           if(!isset($date)){

            $date='"'.date("Y-m-d").'"';

           }else{

            $date='"'.$date.'"';

           }

           $sql = "SELECT moyGeneraleEtudiant($login,$date)";


          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);


     }

     public static function moyenneGeneralePromo($date=NULL, $annee=NULL, $codeDepartement=NULL){

         $etudiant=ModelEtudiants::select($_SESSION['loginUtilisateur']);

 
         if(!isset($date)){

              $date='"'.date("Y-m-d").'"';
            
             }else{

              $date='"'.$date.'"';

          }

          if(!isset($annee)){

              $annee='"'.$etudiant->get('anneeCourantEtudiant').'"';
          }else{

                       $annee='"'.$annee.'"';
          }

          if(!isset($codeDepartement)){
            
              $codeDepartement=$etudiant->get('codeDepartement');
          }



          $sql = "SELECT moyGeneralePromo($date,$annee,$codeDepartement)";

          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);


     }

     public static function moyenneMatiere($login,$codeMatiere,$date){

      $login='"'.$login.'"';
      $date='"'.$date.'"';

         $sql = "SELECT moyMatiereEtudiant($login,$codeMatiere,$date)";

          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);



     }

      public static function moyenneMatierePromo($codeMatiere,$date){

        $date='"'.$date.'"';

         $sql = "SELECT moyMatiereGlobale($codeMatiere,$date)";

          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);



     }

      public static function moyenneCours($login,$codeCours,$date){

      $login='"'.$login.'"';
      $codeCours='"'.$codeCours.'"';
      $date='"'.$date.'"';

         $sql = "SELECT moyCoursEtudiant($login,$codeCours,$date)";

          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);



     }


      public static function moyenneCoursPromo($codeCours,$date){

      $codeCours='"'.$codeCours.'"';
      $date='"'.$date.'"';

         $sql = "SELECT moyCoursGlobale($codeCours,$date)";

          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $var=$rep->fetch();

          return round($var[0],2);



     }


     public static function classementPromo($dpt = NULL, $annee=NULL){

      if(!isset($dpt)){

        $dpt='"'.$_SESSION['codeDepartement'].'"';
        $annee='"'.$_SESSION['anneeCourantEtudiant'].'"';

      }

         $sql = "SELECT codeEtudiant FROM agora_notes N
          JOIN agora_etudiants E ON E.loginEtudiant=N.codeEtudiant 
          WHERE codeDepartement=$dpt AND anneeCourantEtudiant=$annee
          GROUP BY codeEtudiant ORDER BY AVG(note) DESC";


          $rep=Model::$pdo->query($sql);
          $rep->setFetchMode(PDO::FETCH_NUM);

          if($rep==false){

            return -1;
          }
          $tab_login=$rep->fetchAll();

          return $tab_login;

     }


     public static function exerciceDejaFait($codeExercice){

            //Vérifie si un étudiant a déjà réalisé un exercice représenté par $codeExercice
            //Si oui, la fonction renvoie true, sinon false
        
            $sql = "SELECT * from agora_notes WHERE codeEtudiant=:val1 AND codeExercice=:val2";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql); //permet de protéger la requete SQL
            
            $values = array(
                "val1" => $_SESSION['loginUtilisateur'],
                "val2" => $codeExercice,
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_NUM);
            $tab_obj = $req_prep->fetchAll();

            if (empty($tab_obj))
                return false;
            return true;




     }

}
?>
