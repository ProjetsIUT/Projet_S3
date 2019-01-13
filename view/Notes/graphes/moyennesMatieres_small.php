<?php // content="text/plain; charset=utf-8"

			require_once ('jpgraph/src/jpgraph.php');
			require_once ('jpgraph/src/jpgraph_line.php');

			$datay1 = array(1,2,3,4,5);

			$date_4='S-4';
			$date_3='S-3';
			$date_2='S-2';
			$date_1='S-1';
			$date='S';

			$tab_matieres=unserialize($_COOKIE['data3']);
			$tab_moyennes=unserialize($_COOKIE['data4']);

			// Setup the graph
			$graph = new Graph(300,200);
			$graph->SetScale("textlin");

			$theme_class=new UniversalTheme;

			$graph->SetTheme($theme_class);
			$graph->img->SetAntiAliasing(false);
			$graph->SetBox(false);

			$graph->SetMargin(40,20,36,63);

			$graph->img->SetAntiAliasing();

			$graph->yaxis->HideZeroLabel();
			$graph->yaxis->HideLine(false);
			$graph->yaxis->HideTicks(false,false);

			$graph->xgrid->Show();
			$graph->xgrid->SetLineStyle("solid");
 
			$graph->xaxis->SetTickLabels(array($date_4,$date_3,$date_2,$date_1,$date));
			$graph->xgrid->SetColor('#E3E3E3');

			// Create the first line

			$c = 0;

			foreach ($tab_matieres as $nom_matiere) {

				$datay1=array();

				for($i=$c;$i<$c+5;$i++){

					$moyenne=$tab_moyennes[$i];
					array_push($datay1,$moyenne);

				}

				$p1 = new LinePlot($datay1);
				$graph->Add($p1);
				$p1->SetColor('#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
				$p1->SetLegend($nom_matiere);
				
				$c+=5;

			}


			$graph->legend->SetFrameWeight(1);

			// Output line
			$graph->Stroke();

		?>