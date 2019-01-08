

<?php
require_once (File::build_path(array('model','ModelQCM.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelNotes.php')));
require_once (File::build_path(array('model','ModelQuestions.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 

class ControllerQCM extends Controller{

 	protected static $object="QCM";

	public static function show_form_new(){

		$view="ajouterQCM";
		$pagetitle="Créer un nouvel exercice - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function show_form_new_questions(){

		$view="ajouterQCM_questions";
		$pagetitle="Créer un nouvel exercice - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function save_qcm(){

		$codeQCM=uniqid();

		$data=array("codeQCM"=>$codeQCM,"nomQCM"=>$_GET["nom"], "themeQCM"=>$_GET["theme"], "resume"=>$_GET['resume'],"dateQCM"=>date("Y-m-d H:i:s"));
		$new_qcm=new ModelQCM($data);
		$new_qcm->save($data);  

		$c=$_GET['nbQuestions'];
		
		for($i=1;$i<=$c;$i++){

			$data=array("codeQuestion"=>uniqid(),"codeQCM"=>$codeQCM,"intitule"=>$_GET["enonce_question".$i],"proposition1"=>$_GET["proposition1_question".$i],
			"proposition2"=>$_GET["proposition2_question".$i],"proposition3"=>$_GET["proposition3_question".$i],"proposition4"=>$_GET["proposition4_question".$i],
			"propositionExacte"=>$_GET['propositionCorrecte_question'.$i]);
			$q = new ModelQuestions();
	 		$q->save($data);
		}

		$view="created";
		$pagetitle="Votre QCM a été enregistré - Agora";
        require (File::build_path(array('view', 'view.php')));
	}


	public static function list(){

		$tab=ModelQCM::selectAll();
		$view="list";
		$pagetitle="Mes QCMs - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function suppr(){

		$codeQCM = $_GET["code"];
		ModelQCM::delete($codeQCM);
		self::list();


	}

	public static function afficher(){

		$codeQCM = $_GET["code"];
		$qcm=ModelQCM::select($codeQCM);

		$tab_questions_all= ModelQuestions::selectAll();
		$tab_questions=array();

		foreach ($tab_questions_all as $question) {

			if($question->get("codeQCM")==$codeQCM)

				array_push($tab_questions,$question);
	
			}

		$view="detail";
		$pagetitle="Mes QCMs - Agora";
		require (File::build_path(array('view', 'view.php')));

	}


	public static function corriger(){
		
		$codeQCM = $_POST["codeQCM"];
		$tab_questions_all= ModelQuestions::selectAll();
		$compteur = 0;
		$nbReponseJuste = 0;
		foreach ($tab_questions_all as $question) {

			if($question->get("codeQCM")===$codeQCM){

				$compteur ++;
				if($_POST["choix_question".$compteur] === $question->get("propositionExacte")){
					$nbReponseJuste ++;
				}

				var_dump($_POST["choix_question".$compteur]);
				var_dump($question->get("propositionExacte"));
	
			}
	
		}

		$note=$nbReponseJuste/$compteur * 20;
		$note=round($note,2);
		if($compteur != 0){
			$ModelNote = new ModelNotes();
			$ModelNote->save(array(
				"codeNote"=>uniqid(),
				"codeEtudiant"=>$_SESSION["loginUtilisateur"],
				"codeExercice"=>$codeQCM ,
				"typeExercice"=>"QCM",
				"note"=>$note,
				"dateNote"=>date('Y-m-d')
			,));
		
			//header('Location: ./index.php?controller=notes&action=listByEtud');

		}else{
			//header('Location: ./index.php');
		}
		 
	}


}

?>
