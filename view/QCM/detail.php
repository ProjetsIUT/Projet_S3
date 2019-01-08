<div class="page_content">

	<h1><?php echo htmlspecialchars($qcm->get('nomQCM')) ?> <a class="bouton" href="./index.php?controller=QCM&action=list">Retour à liste des QCM</a></h1>
	<h2><?php echo htmlspecialchars($qcm->get('resume'))?></h2>

	<div class="box_center">

		<form method="post" action="./index.php">
		

		<input type="hidden" name="action" value="corriger">
		<input type="hidden" name="controller" value="QCM">
		<input type="hidden" name="codeQCM" value=<?php echo '"'.$_GET["code"].'"'; ?> >
		<?php

			$c=1;

			foreach ($tab_questions as $question) {

				$intitule=htmlspecialchars($question->get('intitule'));
				$proposition1=htmlspecialchars($question->get('proposition1'));
				$proposition2=htmlspecialchars($question->get('proposition2'));
				$proposition3=htmlspecialchars($question->get('proposition3'));
				$proposition4=htmlspecialchars($question->get('proposition4'));
				$propositionExacte=htmlspecialchars($question->get('propositionExacte')); 


				echo('

					<div class="question">

					<h2>Question'. $c . ': '.$intitule.' </h2>

					<input type=radio name="choix_question'.$c.'" id="question'.$c.'_proposition1" value="'.$c. '"required>
					<label for="question'.$c.'_proposition1">'. $proposition1.'</label>
					<br>

					<input type=radio name="choix_question'.$c.'" id="question'.$c.'_proposition2" value="'.$c.'"required>
					<label for="question'.$c.'_proposition2">'. $proposition2.'</label>
					<br>

					<input type=radio name="choix_question'.$c.'" id="question'.$c.'_proposition3" value="'.$c.'"required>
					<label for="question'.$c.'_proposition3">'. $proposition3.'</label>
					<br>

					<input type=radio name="choix_question'.$c.'" id="question'.$c.'_proposition4" value="'.$c.'"required>
					<label for="question'.$c.'_proposition4">'. $proposition4.'</label>
					<br>


					</div>
					'
			    );

				$c++;

			}

		?>


	<input type="submit" value="Terminer">

	</div>


    
    </form>



</div>