<?php
require_once (File::build_path(array('model','ModelrepondreQCM.php')));


class ControllerrepondreQCM{

 	protected static $object="repondreQCM";

	public static function show_form_new(){

		$view="repondreQCM";
		$pagetitle="QCM - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function generer_qcm(){
		echo 'Veuillez fournir une unique réponse à chacune des questions suivantes !';
		$tabQuestion=
		random_int();
		for($i = 1; $i < 9; $i++){
			
			$data=array("codeQCM"=>uniqid(),"nomQCM"=>$_GET["nom"], "question"=>$_GET['enonce'], "proposition1"=>$_GET['proposition_1'], "proposition2"=>$_GET['proposition_2'],"proposition3"=>$_GET['proposition_3'],"proposition4"=>$_GET['proposition_4'], "propositionCorrecte"=>$_GET['reponse_juste']);
			$new_qcm=new ModelQCM($data);
			$new_qcm->save($data); 
						
		}
		$view="created";
		$pagetitle="Vos réponses ont été envoyées - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	

}

?>

