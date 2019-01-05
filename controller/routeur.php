<?php
			$controller_default="utilisateurs"; //Contrôleur par défaut 

			if (isset($_GET['controller'])) {
				$controller=$_GET['controller'];
			}else if (isset($_POST['controller'])){
				$controller=$_POST['controller'];
			}
			else {
				$controller = $controller_default;
			}

			$controller_class="Controller" . ucfirst($controller);

			$path=array("controller","$controller_class.php");
			require_once File::build_path($path);

			if(class_exists($controller_class)) {

				$methods=get_class_methods($controller_class);
				
				if (isset($_GET['action'])) {
					$action=$_GET["action"];
				}else if(isset($_POST['action'])){
					$action=$_POST["action"];
				}else{
					$action = "show_login_page";
				}

				if(in_array($action, $methods)) {
					$controller_class::$action();
				}
				else {
					$controller_class::errorAction();
				}
			}
			else {
				$controller_class = 'ControllerUtilisateurs';
				$controller_class::errorClass();
			}
?>

