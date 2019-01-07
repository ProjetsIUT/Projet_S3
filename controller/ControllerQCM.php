
<?php
require_once (File::build_path(array('model','ModelQCM.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelQuestions.php')));


class ControllerQCM{

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


		self::list();


	}


}

?>

