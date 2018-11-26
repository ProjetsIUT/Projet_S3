<?php
			$controller_class="ControllerGeneral"; //Contrôleur par défaut 
			if (isset($_GET['controller'])) {
				$controller=$_GET['controller'];
				$controller_class="Controller" . ucfirst($controller);
			}else if (isset($_POST['controller'])){
				$controller=$_POST['controller'];
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
			}else if(isset($_POST['action'])){
				$action=$_POST["action"];
				if (in_array($action,$methods)){
					
					$controller_class::$action(); 
				}
        
			}else{
			
				ControllerGeneral::show_error(); //action par défaut
			}
?>

