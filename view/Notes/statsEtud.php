<div class="page_content">

	<h1>Statistiques</h1>

	<div class="box_center">

		<h2>




			<form id=form method=get class="form_filtres" action="./index.php">
					<input type=hidden name=controller value=notes>
					<input type=hidden name=action value=statsEtud>
					<label>Intervalle en jours:</label>
					<input id="input_intervalle" type=number min=1 max=365 name="intervalle" required>
					<img id="icon_refresh" src="./img/icones/refresh.png"  onclick="document.getElementById('form').submit();">


		</form>
		<br>

		</h2>


		


	 <div class="center_content">


	 		<br>

	 		<?php 

	 			if($monClassement==-1){

	 				echo '<a> Vous n\'avez pas encore de statistiques </a> <br> ';
	 			}else{

	 				echo '

	 						<a>Moyenne générale actuelle:' . $moyenneGenerale . '/20</a>
							<br>
							<a>Mon classement:' . $monClassement . ' sur ' . $taillePromo .' étudiants</a>



	 				';

	 			}

	 		?>

		

	 	
	 		<br>

			<img class="graph" src="./view/Notes/graphes/moyenne.php">
			<br>

			<?php 

	 			if($monClassement!=-1){

	 				echo '<img class="graph" src="./view/Notes/graphes/moyennesMatieres.php">';
	 			}

	 		?>
	


	<div>

	</div>	

</div>