
<?php
require_once (File::build_path(array('model','ModelQCM.php')));
require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('model','ModelCours.php')));
require_once (File::build_path(array('model','ModelMatieres.php')));
require_once (File::build_path(array('model','ModelNotes.php')));
require_once (File::build_path(array('model','ModelExerciceClassique.php')));
require_once (File::build_path(array('model','ModelEnseignants.php')));
require_once (File::build_path(array('controller','ControllerEtudiants.php')));
require_once (File::build_path(array('lib','Session.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 
require_once (File::build_path(array('model','ModelFaireExercice.php')));

class ControllerNotes extends Controller { 

 	protected static $object="Notes";


 	public static function listByEtud(){

		if(Session::is_student()) {
			$tab_codesMatieres_etud = ModelMatieres::getAllbyEtud();
			$tab_nomMatieres_etud = array();

			foreach ($tab_codesMatieres_etud as $codeMatiere_etud) {
				$matiere=ModelMatieres::select($codeMatiere_etud);
				array_push($tab_nomMatieres_etud,$matiere->get("nomMatiere"));
			}

			if(!isset($_GET['codeMatiere']) || $_GET['codeMatiere'] === 'all'){


				$tab_notes=ModelNotes::selectByEtud();

				if(!$tab_notes){

					header('Location: ./index.php');
				}

				$tab_notes=array_reverse($tab_notes);
				$nomM = 'Matieres';
				$verif = 'Il n\'y a aucune notes';
			}
			else if(isset($_GET['codeMatiere'])) {
				$m = ModelMatieres::select($_GET['codeMatiere']);
				
				if($m) {
					$nomM = $m->get('nomMatiere');
				}
				else {
					$nomM = 'Matieres';
				}
				$tab_codes_notes=ModelNotes::getNotesByMatieresAndEtud($_GET['codeMatiere']);
				if($tab_codes_notes) {
					$tab_notes=array();
					foreach($tab_codes_notes as $code){
						$note=ModelNotes::select($code);
						array_push($tab_notes,$note);
					}
					
				}
				else {
					$verif = 'Il n\'y a aucune notes pour cette matière';
				}
			}
			
 			$view='listEtud';
        	$pagetitle="Mon relevé de notes - Agora";
        	require (File::build_path(array('view', 'view.php')));
		}
		else {
			header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
		}
 	}

 	public static function list(){
		
		if(Session::is_teacher()) {
			$tab_codesMatieres_enseig = ModelMatieres::getAllbyEnseignant();
			$tab_nomMatieres_enseig = array();

			foreach ($tab_codesMatieres_enseig as $codeMatiere_enseig) {
				$matiere=ModelMatieres::select($codeMatiere_enseig);
				array_push($tab_nomMatieres_enseig,$matiere->get("nomMatiere"));
			}


			if(!isset($_GET['codeMatiere']) || $_GET['codeMatiere'] === 'all'){


				$tab_codes_notes=ModelNotes::getAllByEnseignant();
				
				if($tab_codes_notes) {
					$tab_notes=array();
					foreach($tab_codes_notes as $code){
						$note=ModelNotes::select($code);
						array_push($tab_notes,$note);
					}
					
				}
				else {
					$verif = 'Il n\'y a aucune notes pour cette matière';
				}

				if(!$tab_notes){

					header('Location: ./index.php');
				}

				$tab_notes=array_reverse($tab_notes);
				$nomM = 'Matieres';
				$verif = 'Il n\'y a aucune notes';
			}
			else if(isset($_GET['codeMatiere'])) {
				$m = ModelMatieres::select($_GET['codeMatiere']);
				
				if($m) {
					$nomM = $m->get('nomMatiere');
				}
				else {
					$nomM = 'Matieres';
				}
				$tab_codes_notes=ModelNotes::getNotesByMatieresAndEnseignant($_GET['codeMatiere']);
				if($tab_codes_notes) {
					$tab_notes=array();
					foreach($tab_codes_notes as $code){
						$note=ModelNotes::select($code);
						array_push($tab_notes,$note);
					}
					
				}
				else {
					$verif = 'Il n\'y a aucune notes pour cette matière';
				}
			}
 			$view='list';
        	$pagetitle="Relevé de notes des etudiants- Agora";
        	require (File::build_path(array('view', 'view.php')));
		}
		else {
			header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');
		}
 	}

 	public static function setGraphsEtudiant(){

 		
		 		if(!isset($_GET['intervalle'])){

		 			$intervalle="7";

		 		}else{

		 			$intervalle=($_GET['intervalle']);
		 		}

		 		if(isset($_GET['codeEtudiant'])){

		 			$login=$_GET['codeEtudiant'];

		 		}else{

		 			$login=$_SESSION['loginUtilisateur'];

		 		}

		 				$etudiant=ModelEtudiants::select($login);

		 			if($etudiant){
						
				 		$annee=$etudiant->get('anneeCourantEtudiant');
				 		$codeDpt=$etudiant->get('codeDepartement');

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


						$moyenneg=ModelNotes::moyenneGeneralePromo($date,$annee,$codeDpt);
						$moyenne_g1=ModelNotes::moyenneGeneralePromo($date_1,$annee,$codeDpt);
						$moyenne_g2=ModelNotes::moyenneGeneralePromo($date_2,$annee,$codeDpt);
						$moyenne_g3=ModelNotes::moyenneGeneralePromo($date_3,$annee,$codeDpt);
						$moyenne_g4=ModelNotes::moyenneGeneralePromo($date_4,$annee,$codeDpt);


						$dates=array($date_4,$date_3,$date_2,$date_1,$date);
						$datay1=array($moyenne_4,$moyenne_3,$moyenne_2,$moyenne_1,$moyenne);
						$datay2=array($moyenne_g4,$moyenne_g3,$moyenne_g2,$moyenne_g1,$moyenneg);

						setcookie("dates",serialize($dates),time()+3600);
						setcookie("data",serialize($datay1),time()+3600);
						setcookie("data2",serialize($datay2),time()+3600);

						if(Session::is_student()){

							$tab_codesMatieres=ModelMatieres::getAllByEtud();

						}else{

							$tab_codesMatieres=ModelMatieres::getAllByEnseignant();
						
						}

						$tab_noms_matieres=array();
						$tab_moyennes= array();

					if($tab_codesMatieres){	
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
					}

	 			
 	
 	}

 	public static function statsEtud(){

 		if(!Session::is_student()){

 	 		header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');


 	 	}else{

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

 	public static function setGraphsEnseignant(){

 		if(!isset($_GET['intervalle'])){

 			$intervalle="7";

 		}else{

 			$intervalle=($_GET['intervalle']);
 		}


		$date=date("Y-m-d");
		$date_1 = date("Y-m-d",strtotime($date."- ".$intervalle." days"));
		$date_2 = date("Y-m-d", strtotime($date_1."- ".$intervalle." days"));
		$date_3 = date("Y-m-d",strtotime($date_2."- ".$intervalle." days"));
		$date_4 = date("Y-m-d",strtotime($date_3."- ".$intervalle." days"));


		$dates=array($date_4,$date_3,$date_2,$date_1,$date);
		setcookie("dates",serialize($dates),time()+3600);


		$tab_codesMatieres=ModelMatieres::getAllByEnseignant();
	
		if(isset($_GET['codeMatiere']) && $_GET['codeMatiere']!='all' && !isset($codeEtudiant)){

			$tab_codesMatieres=array();
			array_push($tab_codesMatieres,$_GET['codeMatiere']);

		}


		if(isset($_GET['codeMatiere']) && isset($_GET['codeEtudiant']) && $_GET['codeEtudiant']!='all' && $_GET['codeMatiere']!='all'){

			$login=$_GET['codeEtudiant'];
			
			$tab_codesMatieres=array();
			array_push($tab_codesMatieres,$_GET['codeMatiere']);
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


		}else{


			$tab_noms_matieres=array();
			$tab_moyennes= array();


			foreach ($tab_codesMatieres as $codeMatiere) {
				
				$matiere=ModelMatieres::select($codeMatiere);
				$nom_matiere=$matiere->get('nomMatiere');
				$moyenne_4=ModelNotes::moyenneMatierePromo($codeMatiere,$date_4);
				array_push($tab_moyennes,$moyenne_4);
				$moyenne_3=ModelNotes::moyenneMatierePromo($codeMatiere,$date_3);
				array_push($tab_moyennes,$moyenne_3);
				$moyenne_2=ModelNotes::moyenneMatierePromo($codeMatiere,$date_2);
				array_push($tab_moyennes,$moyenne_2);
			    $moyenne_1=ModelNotes::moyenneMatierePromo($codeMatiere,$date_1);
			    array_push($tab_moyennes,$moyenne_1);
			    $moyenne=ModelNotes::moyenneMatierePromo($codeMatiere,$date);
			    array_push($tab_moyennes,$moyenne);
				array_push($tab_noms_matieres, $nom_matiere);
			}



		}
		

		setcookie("data3",serialize($tab_noms_matieres),time()+3600);
		setcookie("data4",serialize($tab_moyennes),time()+3600);


		if(isset($_GET['codeCours']) && !isset($codeEtudiant) && $_GET['codeCours']!="all"){

			$codeCours=$_GET['codeCours'];

			$moyenne=ModelNotes::moyenneCoursPromo($codeCours,$date);
			$moyenne_1=ModelNotes::moyenneCoursPromo($codeCours,$date);
			$moyenne_2=ModelNotes::moyenneCoursPromo($codeCours,$date);
			$moyenne_3=ModelNotes::moyenneCoursPromo($codeCours,$date);
			$moyenne_4=ModelNotes::moyenneCoursPromo($codeCours,$date);

			$datay1=array($moyenne_4,$moyenne_3,$moyenne_2,$moyenne_1,$moyenne);

			setcookie("data",serialize($datay1),time()+3600);


		}




		if(isset($_GET['codeCours']) && isset($_GET['codeEtudiant']) && $_GET['codeEtudiant']!='all'){

			$codeCours=$_GET['codeCours'];
			$login=$_GET['codeEtudiant'];

			$moyenne=ModelNotes::moyenneCours($login,$codeCours,$date);
			$moyenne_1=ModelNotes::moyenneCours($login,$codeCours,$date);
			$moyenne_2=ModelNotes::moyenneCours($login,$codeCours,$date);
			$moyenne_3=ModelNotes::moyenneCours($login,$codeCours,$date);
			$moyenne_4=ModelNotes::moyenneCours($login,$codeCours,$date);

			$datay1=array($moyenne_4,$moyenne_3,$moyenne_2,$moyenne_1,$moyenne);

			setcookie("data",serialize($datay1),time()+3600);


		}



 	}

 	 public static function statsEnseignant(){

 	 	if(!Session::is_teacher()){

 	 		header('Location: ./index.php?controller=Utilisateurs&action=show_login_page');


 	 	}else{

	 	 	self::setGraphsEtudiant();
	 		self::setGraphsEnseignant();

			$view='statsEnseignant';
	      	$pagetitle="Statistiques des étudiants - Agora";
	        require (File::build_path(array('view', 'view.php')));

 	 	}




 	}

 	public static function noteExerciceClassique(){

 		$id = $_POST['id'];
 		$loginEtudiant = $_POST['loginEtudiant'];
 		$correction = $_POST['correction'];


 		$data = array('codeNote' => uniqid() , 'codeEtudiant' => $loginEtudiant, 'codeExercice' => $id, 'typeExercice' => 'Exercice Classique', 'note' => $_POST["note"], "dateNote" => date("Y-m-d H:i:s") );
 		$note = new ModelNotes($data);
 		$faireEx = ModelFaireExercice::selectFaireExercice($id, $loginEtudiant);
 		$faireEx->addCorrection($id, $loginEtudiant, $correction);
 		$note->save($data);


 		self::list();
 	}


}

?> 	


