<?php


$path=array('model','ModelEnseignants.php');
require_once File::build_path($path);

$path=array('lib','Security.php');
require_once File::build_path($path);
require_once (File::build_path(array('controller', 'Controller.php'))); 
class ControllerMatieres extends Controller{

	protected static $object = "matieres";
	
 

}


?>