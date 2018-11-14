<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<title><?php echo $pagetitle?></title>
			<link rel="stylesheet" type="text/css" href=<?php echo (File::build_path(array('style.css'))) ?>>
	</head>
	<body>
	
		<header>
				<div id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </div>

				
				<nav>

						<div class="menu">
							Cours
						</div>
						<div class="menu">
							Exercices
						</div>
						<div class="menu">
							Statistiques
						</div>
						
						
				</nav>

				
				<div id="connexion"><a id="connexion_inscription">Connexion | Inscription</a></div>
		</header>

		<?php


			$filepath = File::build_path(array("view", ucfirst(self::$object), "$view.php"));
			require $filepath;

		?>


	</body>
</html>
