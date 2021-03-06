
<?php

$path=array('model','Model.php');
require_once File::build_path($path);
 
class ModelMatieres extends Model {

	protected static $object="matieres";
	protected static $primary="codeMatiere";

	protected $codeMatiere;
	protected $nomMatiere;
	protected $codeDepartement;

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

      $this->codeMatiere=$data['codeMatiere'];
      $this->nomMatiere= $data["nomMatiere"];
      $this->codeDepartement=$data["codeDepartement"];

    }


  }


  public static function getAllByEtud($login=NULL){

    //Retourne toutes les matières (par leur code) dans lesquelles est inscrit un étudiant ($login)


          if(!isset($login)){

             $login = '"'.$_SESSION['loginUtilisateur'].'"';

          } 


          $sql = "SELECT codeMatiere from agora_suitMatiere WHERE loginEtudiant=$login";
          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codesMatiere = $rep->fetchAll();

          $tab =array();

          foreach ($tab_codesMatiere as $key) { 

            array_push($tab,$key[0]);

          }
          if (empty($tab)) {
            return false;
          }
 
          return $tab;


  }


  public static function getAllByEnseignant(){

          //Retourne toutes les matières (par leur code) dans lesquelles enseigne un enseignant ($login)

          $login='"'.$_SESSION['loginUtilisateur'].'"';

          $sql = "SELECT codeMatiere from agora_enseigner WHERE codeEnseignant=$login";
          $rep = Model::$pdo->query($sql);

          $rep->setFetchMode(PDO::FETCH_NUM);
          $tab_codesMatiere = $rep->fetchAll();

          $tab =array();

          foreach ($tab_codesMatiere as $key) { 

            array_push($tab,$key[0]);

          }


          return $tab;





  }

  public static function saveAssociation($login,$codeMatiere){

      $u = ModelUtilisateurs::select($login);


      if($u->get('typeUtilisateur')==='etudiant'){

          $sql = "INSERT INTO agora_suitMatiere VALUES (:val1, :val2)";


      }else{

          $sql = "INSERT INTO agora_enseigner VALUES (:val1, :val2) ";

      }



      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "val1" => $login,
        "val2" => $codeMatiere,
      );
      $req_prep->execute($values);



  }



}



?>