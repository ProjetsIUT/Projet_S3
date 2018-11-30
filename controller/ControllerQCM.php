
<?php
require_once (File::build_path(array('model','ModelQCM.php')));


class ControllerQCM{

 	protected static $object="QCM";

	public static function show_form_new(){

		$view="ajouterQCM";
		$pagetitle="Créer un nouvel exercice - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function save_qcm(){

		$data=array("codeQCM"=>uniqid(),"nomQCM"=>$_GET["nom"], "question"=>$_GET['enonce'], "proposition1"=>$_GET['proposition_1'], "proposition2"=>$_GET['proposition_2'],"proposition3"=>$_GET['proposition_3'],"proposition4"=>$_GET['proposition_4'], "propositionCorrecte"=>$_GET['reponse_juste']);
		$new_qcm=new ModelQCM($data);
		$new_qcm->save($data);  

		$view="created";
		$pagetitle="Votre QCM a été enregistré - Agora";
        require (File::build_path(array('view', 'view.php')));
	}

	

}

?>

