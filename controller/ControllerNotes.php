
<?php
require_once (File::build_path(array('model','ModelQCM.php')));
require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelMatieres.php')));
require_once (File::build_path(array('model','ModelNotes.php')));
require_once (File::build_path(array('model','ModelExerciceClassique.php')));
require_once (File::build_path(array('controller','ControllerEtudiants.php')));


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

 	public static function setGraphsEtudiant(){


 			if(!isset($_GET['intervalle'])){

 			$intervalle="7";
 		}else{

 			$intervalle=($_GET['intervalle']);
 		}

 		$login=$_SESSION['loginUtilisateur'];

		$date=date("Y-m-d");
		$date_1 = date("Y-m-d",strtotime($date."- ".$intervalle." days"));
		$date_2 = date("Y-m-d", strtotime($date_1."- ".$intervalle." days"));
		$date_3 = date("Y-m-d",strtotime($date_2."- ".$intervalle." days"));
		$date_4 = date("Y-m-d",strtotime($date_3."- ".$intervalle." days"));

		$moyenne=ModelNotes::moyenneGenerale($login,$date);
		$moyenne_1=ModelNotes::moyenneGenerale($login,$date_1);
		$moyenne_2=ModelNotes::moyenneGenerale($login,$date_2);
		$moyenne_3=ModelNotes::moyenneGenerale($login,$date_3);
		$moyenne_4=ModelNotes::moyenneGenerale($login,$date_4);


		$moyenneg=ModelNotes::moyenneGeneralePromo($date);
		$moyenne_g1=ModelNotes::moyenneGeneralePromo($date_1);
		$moyenne_g2=ModelNotes::moyenneGeneralePromo($date_2);
		$moyenne_g3=ModelNotes::moyenneGeneralePromo($date_3);
		$moyenne_g4=ModelNotes::moyenneGeneralePromo($date_4);


		$dates=array($date_4,$date_3,$date_2,$date_1,$date);
		$datay1=array($moyenne_4,$moyenne_3,$moyenne_2,$moyenne_1,$moyenne);
		$datay2=array($moyenne_g4,$moyenne_g3,$moyenne_g2,$moyenne_g1,$moyenneg);

		setcookie("dates",serialize($dates),time()+3600);
		setcookie("data",serialize($datay1),time()+3600);
		setcookie("data2",serialize($datay2),time()+3600);



		$tab_codesMatieres=ModelMatieres::getAllByEtud();
<<<<<<< HEAD

=======
 
>>>>>>> dd14ff15afa2592570a067d5c17719cd4669b1c4
		$tab_noms_matieres=array();
		$tab_moyennes= array();


		foreach ($tab_codesMatieres as $codeMatiere) {
			
			$matiere=ModelMatieres::select($codeMatiere);
			$nom_matiere=$matiere->get('nomMatiere');
			$moyenne_4=ModelNotes::moyenneMatiere($login,$codeMatiere,$date_4);
			array_push($tab_moyennes,$moyenne_4);
			$moyenne_3=ModelNotes::moyenneMatiere($login,$codeMatiere,$date_3);
			array_push($tab_moyennes,$moyenne_3);
			$moyenne_2=ModelNotes::moyenneMatiere($login,$codeMatiere,$date_2);
			array_push($tab_moyennes,$moyenne_2);
		    $moyenne_1=ModelNotes::moyenneMatiere($login,$codeMatiere,$date_1);
		    array_push($tab_moyennes,$moyenne_1);
		    $moyenne=ModelNotes::moyenneMatiere($login,$codeMatiere,$date);
		    array_push($tab_moyennes,$moyenne);
			array_push($tab_noms_matieres, $nom_matiere);
		}

		setcookie("data3",serialize($tab_noms_matieres),time()+3600);
		setcookie("data4",serialize($tab_moyennes),time()+3600);
 	}

 	public static function statsEtud(){

 		self::setGraphsEtudiant();

 		$moyenneGenerale=ModelNotes::moyenneGenerale();
 		$monClassement= ControllerEtudiants::getRang();
 		$taillePromo = ControllerEtudiants::nbEtudiants();
 		$classement=ModelNotes::classementPromo();

		$tab_logins=ModelNotes::classementPromo();
		$taillePromo= count($tab_logins);


		$view='statsEtud';
      	$pagetitle="Relevé de notes - Agora";
        require (File::build_path(array('view', 'view.php')));


 	}




 	


}



?>