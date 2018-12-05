<!DOCTYPE html>
<html id=<?php if(isset($page_id)){ echo ($page_id); } ?>>
    <head>
		<meta charset="utf-8" />
		<title><?php echo $pagetitle?></title>
			<link rel="stylesheet" type="text/css" href="./style.css">
	
<header>
				<a href="./" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>

				
				<nav>

						<a class="menu" href="index.php?controller=cours&action=list">Cours</a>
					
						<a class="menu" href=<?php echo (File::build_path(array('index.php'))) . '?controller=QCM&action=show_form_new' ?>>Exercices</a>
						
						<a class="menu">Statistiques</a>
					
				</nav>

				
				<div id="connexion" ><a href=<?php echo (File::build_path(array('index.php'))) . '?controller=Utilisateurs&action=show_login_page' ?> style="text-decoration:none;" id="connexion_inscription">Connexion | Inscription</a></div>
		</header>
	</head>

	<body >
	


		<?php


			$filepath = File::build_path(array("view", ucfirst(self::$object), "$view.php"));
			require $filepath; 

		?>


	</body>
</html>
