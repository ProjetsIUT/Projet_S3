<?php

<<<<<<< HEAD
require_once (File::build_path(array('controller', 'ControllerUtilisateur.php')));
$controller_default = 'utilisateur';

if(isset($_COOKIE['preference'])) {
	$controller_default = unserialize($_COOKIE['preference']);
}

if(!isset($_GET['controller'])) {
	$controller = $controller_default;
} else {
	$controller = $_GET['controller'];
}

$controller_class = 'Controller' . ucfirst($controller);

if(class_exists($controller_class)){
	
	if(!isset($_GET['action'])) {
		$action = 'selectAll';
	}
	else {
		$action = $_GET['action'];
	}

	if (isset($action)) {

		$class_methods = get_class_methods($controller_class);

		if(in_array($action, $class_methods)) {
			$controller_class::$action();
		}
		else {
			$view = 'error';
			$pagetitle = 'Erreur';
			require (File::build_path(array('view', 'view.php')));
		}
	}

}
else {
	$view = 'error';
	$pagetitle = 'Erreur';
	require (File::build_path(array('view', 'view.php')));
}
=======
			$controller_class="ControllerGeneral"; //Contrôleur par défaut 



			if (isset($_GET['controller'])) {

				$controller=$_GET['controller'];
				$controller_class="Controller" . ucfirst($controller);

			}

			$path=array("controller","$controller_class.php");
			require File::build_path($path);

			$methods=get_class_methods($controller_class);


			if (isset($_GET['action'])) {

				$action=$_GET["action"];


				if (in_array($action,$methods)){

					
					$controller_class::$action(); 
				}
        

			}else{

			
				ControllerGeneral::show_error(); //action par défaut

			}

>>>>>>> master

?>