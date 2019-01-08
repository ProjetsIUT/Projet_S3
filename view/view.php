
<!DOCTYPE html>

<html id=<?php if(isset($page_id)){ echo ($page_id); } ?>>
    <head>
		<link rel="icon" href="img/Agora_icone_finale_CR_JulieValentin.png" />
		<meta charset="utf-8" />
		<title><?php echo $pagetitle?></title>
			<link rel="stylesheet" type="text/css" href="./style.css">
	
<header>
				<?php
				if (Session::is_teacher()) {
					echo '<a href="index.php?controller=enseignants&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				else if (Session::is_student()) {
					echo '<a href="index.php?controller=etudiants&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				else if (Session::is_admin()) {
					echo '<a href="index.php?controller=administrateur&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				} 
				else if (!isset($_SESSION['typeUtilisateur'])){
					echo '<a href="index.php?controller=Utilisateurs&action=show_login_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				?>
				
				<nav>


						<a class="menu" href="index.php?controller=cours&action=list">Cours</a>
					
						<a class="menu" href="index.php?controller=QCM&action=list">Exercices</a> 
						
						<a class="menu" <?php if(Session::is_student()){echo('href="./index.php?controller=notes&action=statsEtud"');} ?>>Statistiques</a>
					
				</nav>

				<?php

				if(isset($_SESSION['typeUtilisateur'])) {
					echo '<div id="connexion" ><a href="index.php?controller=Utilisateurs&action=deconnected" id="connexion_inscription">Deconnexion</a></div>';
				}
				else {
					echo '<div id="connexion" ><a href="index.php?controller=Utilisateurs&action=show_login_page" id="connexion_inscription">Connexion</a></div>';
				}
				?>
</header>
	</head>

	<body >
	


		<?php


			$filepath = File::build_path(array("view", ucfirst(self::$object), "$view.php"));
			require $filepath;

		?>


	</body>
</html>

