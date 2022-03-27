<?php // content="text/plain; charset=utf-8"
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_bar.php');
require_once "./include/functions.inc.php";

$visits = getVisits();

$data1 = array_map(function(array $a){
    return $a[3];
},$visits);


// Create the graph. These two calls are always required
$graph = new Graph(640,360,'auto');
$graph->SetScale("textint");


$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);


$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array_map(function(array $a){
    return $a[1];
},$visits));

$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data1);
$b1plot->SetAbsWidth(5);


// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#cc1111");

$graph->SetAngle(0);
$graph->xaxis->SetLabelAlign('right','center','right');
$graph->yaxis->SetLabelAlign('center','bottom');

$graph->yaxis->scale->SetGrace(50);
$graph->xaxis->scale->SetGrace(50);
$graph->xaxis->SetLabelMargin(10);
$graph->yaxis->SetLabelMargin(0);


// Display the graph
$graph->Stroke();
?>