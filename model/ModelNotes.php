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


     public static function selectByEtud() {

     	    	$login = '"'.$_SESSION['loginUtilisateur'].'"';

            $sql = "SELECT * from agora_notes WHERE codeEtudiant=$login";
            $rep = Model::$pdo->query($sql);

		        $rep->setFetchMode(PDO::FETCH_CLASS, "ModelNotes");
            $tab_obj = $rep->fetchAll();

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


          var_dump(count($tab_login));
          return $tab_login;

     }

}


?>