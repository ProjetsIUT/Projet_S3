<?php // content="text/plain; charset=utf-8"

			require_once ('jpgraph/src/jpgraph.php');
			require_once ('jpgraph/src/jpgraph_line.php');

			$dates=unserialize($_COOKIE['dates']);
			$date_4=$dates[0];
			$date_3=$dates[1];
			$date_2=$dates[2];
			$date_1=$dates[3];
			$date=$dates[4];

		
			$datay1=unserialize($_COOKIE['data']);


			// Setup the graph
			$graph = new Graph(1400,550);
			$graph->SetScale("textlin");

			$theme_class=new UniversalTheme;

			$graph->SetTheme($theme_class);
			$graph->img->SetAntiAliasing(false);
			$graph->title->Set('Moyenne de la promotion au cours');
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
			$p1 = new LinePlot($datay1);
			$graph->Add($p1);
			$p1->SetColor("#6495ED");
			$p1->SetLegend('Cours sélectionné');

			$graph->legend->SetFrameWeight(1);

			// Output line
			$graph->Stroke();

		?>