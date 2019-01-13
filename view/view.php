
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

						<ul>

						<li class="menu1"><a class="menu" href="index.php?controller=cours&action=list">Cours</a>
			
	
						</li>

						<li class="menu2"><a class="menu">Exercices</a> 

							<ul class="sous_menu">

								<li><a class="menu texte_sous_menu" href="index.php?controller=QCM&action=list">QCMs</a></li>
								<li><a class="menu texte_sous_menu" href="index.php?controller=ExerciceClassique&action=list">Classiques</a></li>

							</ul>

						</li>

						
						<?php

							if(Session::is_teacher()){

									echo'<li class="menu3"><a class="menu" href="./index.php?controller=notes&action=statsEnseignant">Statistiques</a>';

							}else{

									echo'<li class="menu3"><a class="menu"  href="./index.php?controller=notes&action=statsEtud" >Statistiques</a>';
							}

						?>

					


						</li>
					
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

