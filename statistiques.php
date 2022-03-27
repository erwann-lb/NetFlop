<?php
	$title="Statistiques";
	require_once "./include/functions.inc.php";
	require "./include/header.inc.php";
?>

	<section><h1 style="color:firebrick;font-size: 40px;text-align: center;font-family: arial">Statistiques</h1>
		<article class = "statistiques"><h2>Médias les plus consultés</h2>
			<div>
				<img src="graph.php" alt="Les Films les plus vus">
			</div>
		</article>
	</section>

<?php
	$title="footer";
	require "./include/footer.inc.php";
?>