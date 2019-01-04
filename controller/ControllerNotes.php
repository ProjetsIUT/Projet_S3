
<?php
require_once (File::build_path(array('model','ModelQCM.php')));
require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelNotes.php')));
require_once (File::build_path(array('model','ModelExerciceClassique.php')));


class ControllerNotes{

 	protected static $object="Notes";


 	public static function listByEtud(){

 		if(isset($_SESSION['loginUtilisateur']) && $_SESSION['typeUtilisateur']==="etudiant"){

 			$tab_notes=ModelNotes::selectByEtud();
 			$view='listEtud';
      	 	$pagetitle="Relevé de notes - Agora";
        	require (File::build_path(array('view', 'view.php')));


 		}else{

 			header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');

 		}

 	

 	}

 	public static function list(){
 	
 		$tab_notes=ModelNotes::selectAll();
 		$view='list';
        $pagetitle="Relevé de notes - Agora";
        require (File::build_path(array('view', 'view.php')));

 	}

 	


}



?>